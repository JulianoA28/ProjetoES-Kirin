<?php

include_once '..\model\Livrolocado.php';
include_once '..\persistence\connection.php';
include_once '..\persistence\locacaoDAO.php';
include_once '..\controller\locacaoController.php';
include_once '..\persistence\clienteDAO.php';
include_once '..\persistence\livrolocadoDAO.php';
include_once '..\persistence\livroDAO.php';

$conexao = new connection();
$conexao = $conexao->getConnection();

$locacaoDAO = new locacaoDAO();
$clienteDAO = new clienteDAO();
$livrolocadoDAO = new livrolocadoDAO();
$livroDAO = new livroDAO();

$id = $_POST['bta'];
$cpfCliente = $_POST['ncpf'];
$dataLimite = $_POST['ndata'];

if ($dataLimite != "") {
	$locacaoDAO->alterar($id, null, $dataLimite, $conexao);
}

$resultLocacao = $locacaoDAO->selecionar("*", "Id", $id, $conexao);
$rowLocacao = mysqli_fetch_array($resultLocacao);

$checagemCpf = true;
// Checagem CPF
if ($cpfCliente != "") {
	if (!$clienteDAO->selecionar("*", "Cpf", $cpfCliente, $conexao)) {
		$checagemCpf = false;
	}
}
else {
	$cpfCliente = $rowLocacao['CpfCliente'];
}
if ($checagemCpf) {
	

	$resultLivrolocado = $livrolocadoDAO->selecionar("*", "IdLocacao", $id, $conexao);
	$qtdLivros = mysqli_num_rows($resultLivrolocado);

	$i = 1;
	while ($row = mysqli_fetch_array($resultLivrolocado)) {
		
		$array = explode(",", $_POST["opcao$i"]);
		$idLivro = array_pop($array);
		$opcao = array_pop($array);
		
		if ($opcao == "devolver") {
			$livrolocadoDAO->excluir($idLivro, $conexao);
			$livroDAO->desalocar($idLivro, $conexao);
		}
		else if ($opcao == "alterar") {
			if ($_POST[$i] != "") {
				$livrolocadoDAO->excluir($idLivro, $conexao);
				$livroDAO->desalocar($idLivro, $conexao);
				
				$idLivro = $_POST[$i];
				$livrolocado = new Livrolocado($id, $idLivro, $cpfCliente);
				$livrolocadoDAO->inserir($livrolocado, $conexao);
				$livroDAO->locar($idLivro, $conexao);
			}
		
		}
		else {
			if ($cpfCliente != $row['CpfCliente']) {
				$livrolocadoDAO->excluir($idLivro, $conexao);
				
				$livrolocado = new Livrolocado($id, $idLivro, $cpfCliente);
				$livrolocadoDAO->inserir($livrolocado, $conexao);
			}
			
		}
			
	
	}
	
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
	echo "<h1>Cpf invalido!</h1>";
	echo "<form action='retornar.php' method='post'><button type='submit' value='consultarlocacao' name='bt'>Voltar</button></form>";
}
	


?>
