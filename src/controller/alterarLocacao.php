<?php

// Arquivo: rotaLocacao.php
// Tem como base receber o id de uma locacao e enviar os dados para um controller que ira realizar as acoes de exclusao ou alteracao

include_once '..\model\Livrolocado.php';
include_once 'locacaoController.php';
include_once '..\persistence\connection.php';
include_once '..\persistence\locacaoDAO.php';
include_once '..\controller\locacaoController.php';
include_once '..\persistence\clienteDAO.php';
include_once '..\persistence\livrolocadoDAO.php';
include_once '..\persistence\livroDAO.php';


// Criando conexao e objetos DAO
$conexao = new connection();
$conexao = $conexao->getConnection();

$locacaoDAO = new locacaoDAO();
$clienteDAO = new clienteDAO();
$livrolocadoDAO = new livrolocadoDAO();
$livroDAO = new livroDAO();

// Recebendo informacoes do formulario
$id = $_POST['bta'];
$cpfCliente = $_POST['ncpf'];
$dataLimite = $_POST['ndata'];

$cpf = null;
$data = null;

$resultLocacao = $locacaoDAO->selecionar("*", "Id", $id, $conexao);
$rowLocacao = mysqli_fetch_array($resultLocacao);

// Realizando a checagem da nova Data e do novo CPF
$checagemData = true;
if ($dataLimite != "") {
	if (checarData($dataLimite, $rowLocacao['DataLimite'])) {
		$checagemData = false;
	}
	$data = $dataLimite;
}

$checagemCpf = true;
if ($cpfCliente != "") {
	if (!$clienteDAO->selecionar("*", "Cpf", $cpfCliente, $conexao)) {
		$checagemCpf = false;
	}
	$cpf = $cpfCliente;
}
else {
	$cpfCliente = $rowLocacao['CpfCliente'];
}

if ($checagemCpf and $checagemData) {
	
	$locacaoDAO->alterar($id, $cpf, $data, $conexao);
	if ($cpf != null) {
		echo "<h2>CPF da Locacao alterado!</h2>";
	}
	if ($data != null) {
		echo "<h2>Data Limite alterada!</h2>";
	}
	
	$resultLivrolocado = $livrolocadoDAO->selecionar("*", "IdLocacao", $id, $conexao);
	$qtdLivros = mysqli_num_rows($resultLivrolocado);
	
	// Percorrendo os livros atuais da locacao
	$i = 1;
	while ($row = mysqli_fetch_array($resultLivrolocado)) {
		
		// Pegando o valor do form (arquivo rotaLocacao.php)
		// opcao,idLivro
		// Opcao -> manter, devolver ou alterar
		$array = explode(",", $_POST["opcao$i"]);
		$idLivro = array_pop($array);
		$opcao = array_pop($array);
		
		if ($opcao == "devolver") {
			if ($livrolocadoDAO->excluir($idLivro, $conexao)) {
				echo "<h4> Livro de ID $idLivro devolvido com sucesso!</h4>";
			}
			$livroDAO->desalocar($idLivro, $conexao);
			
		}
		$i = $i + 1;
	}
	
	// Percorrendo os novos livros a serem adicionados
	$pos = 1;
	while (True) {
		if (!isset($_POST[$pos])) {
			break;
		}
		else {
			// Recebendo o ID do livro e checando se esta devidamente cadastrado
			$idLivro = $_POST[$pos];
			$resultLivro = $livroDAO->selecionar("*", $idLivro, $conexao);
			$num = mysqli_num_rows($resultLivro);
			if ($num == 1) {
				$rowLivro = mysqli_fetch_array($resultLivro);
				if (!$rowLivro['Locado']) {
					$livrolocado = new Livrolocado($id, $idLivro);
					if ($livrolocadoDAO->inserir($livrolocado, $conexao)) {
						echo "<h4>$idLivro foi locado com sucesso!</h4>";
					$livroDAO->locar($idLivro, $conexao);
					}
				}
				else {
					echo "<h4>$rowLivro[Id] ja esta locado!</h4>";
				}
			
			}
			else {
				if (strlen($idLivro) != 6) {
					echo "<h4> O ID $idLivro nao esta no formato adequado! </h4>";
				}
				else {
					echo "<h4> O ID $idLivro nao esta cadastrado! </h4>";
				}
				
			}
			
		}
		$pos = $pos + 1;
	}
	echo "<form action='retornar.php' method='post'><button type='submit' value='consultarlocacao' name='bt'>Voltar</button></form>";
	
}
// Erro detectado
else {
	$mensagem = "";
	if (!$checagemCpf and !$checagemData) {
		$mensagem = $mensagem . "Cpf e Data invalidos! &nbsp;";
	}
	else if (!$checagemData) {
		$mensagem = $mensagem . "Data invalida! ";
	}
	else if (!$checagemCpf) {
		$mensagem = $mensagem . "Cpf invalido! &nbsp;";
	}
	echo "<h1>$mensagem</h1>";
	echo "<form action='retornar.php' method='post'><button type='submit' value='consultarlocacao' name='bt'>Voltar</button></form>";
}
	


?>
