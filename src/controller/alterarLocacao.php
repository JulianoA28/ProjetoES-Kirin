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
	
	if ($cpf == null) {
		$cpf = $rowLocacao['CpfCliente'];
	}
	
	$resultLivrolocado = $livrolocadoDAO->selecionar("*", "IdLocacao", $id, $conexao);
	$qtdLivros = mysqli_num_rows($resultLivrolocado);
	
	// Percorrendo os livros atuais da locacao
	$i = 1;
	while ($row = mysqli_fetch_array($resultLivrolocado)) {
		
		echo "$row[IdLivro] -";
		
		// Pegando o valor do form (arquivo rotaLocacao.php)
		// opcao,idLivro
		// Opcao -> manter, devolver ou alterar
		$array = explode(",", $_POST["opcao$i"]);
		$idLivro = array_pop($array);
		$opcao = array_pop($array);
		
		if ($opcao == "devolver") {
			$livrolocadoDAO->excluir($idLivro, $conexao);
			$livroDAO->desalocar($idLivro, $conexao);
		}
		else if ($opcao == "manter") {

			$livrolocadoDAO->excluir($idLivro, $conexao);
				
			$livrolocado = new Livrolocado($id, $idLivro, $cpf);
			$livrolocadoDAO->inserir($livrolocado, $conexao);
			
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
			$idLivro = $_POST[$pos];
			$resultLivro = $livroDAO->selecionar("*", $idLivro, $conexao);
			$num = mysqli_num_rows($resultLivro);
			if ($num == 1) {
				$rowLivro = mysqli_fetch_array($resultLivro);
				if (!$rowLivro['Locado']) {
					$livrolocado = new Livrolocado($id, $idLivro, $cpfCliente);
					$livrolocadoDAO->inserir($livrolocado, $conexao);
					$livroDAO->locar($idLivro, $conexao);
				}
			
			}
			
		}
		$pos = $pos + 1;
	}
	echo "<form action='retornar.php' method='post'><button type='submit' value='consultarlocacao' name='bt'>Voltar</button></form>";
	
}
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
