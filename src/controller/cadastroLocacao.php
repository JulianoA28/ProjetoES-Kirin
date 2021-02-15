<?php

include_once '..\persistence\connection.php';
include_once '..\persistence\locacaoDAO.php';
include_once '..\model\Locacao.php';
include_once '..\persistence\clienteDAO.php';
include_once '..\persistence\livroDAO.php';

$cpfCliente = $_POST['ccpf'];
$idLivros = $_POST['cidl'];
$dataLimite = $_POST['cdata'];

$locacao = new Locacao($cpfCliente, $idLivros, $dataLimite);

$conexao = new connection();
$conexao = $conexao->getConnection();

$locacaoDAO = new locacaoDAO();
$clienteDAO = new clienteDAO();
$livroDAO = new livroDAO();

$invalido = false;
$mensagem = "";

$mensagem = $mensagem . "<br>";

$result = $clienteDAO->selecionar("Cpf", "Cpf", $cpfCliente, $conexao);
if (!$result) {
	$invalido = true;
	$mensagem = "Cpf invalido!";
}

$listaLivros = explode(",", $idLivros);
foreach($listaLivros as $idLivro) {
	
	$result = $livroDAO->selecionar("*", $idLivro, $conexao);
	$row = mysqli_fetch_array($result);
	if ($row == null) {
		$invalido = true;
		$mensagem = $mensagem . "$idLivro invalido!<br>";
	}
	else if ($row['Locado']) {
		$invalido = true;
		$mensagem = $mensagem . "$idLivro ja locado!<br>";
	}

}
	
if (!$invalido) {
	
	foreach($listaLivros as $idLivro) {
		
		$livroDAO->locar($idLivro, $conexao);
		
	}
	
	$cadastradoCpf = $clienteDAO->selecionar("Cpf", "Cpf", $cpfCliente, $conexao);
	if ($cadastradoCpf) {
		$mensagem = "";
		if ($locacaoDAO->inserir($locacao, $conexao)) {
			$mensagem = "Locacao cadastrada com sucesso!";
		}
		else {
			$mensagem = "Erro ao cadastrar locacao!";
		}
		echo "<h1>$mensagem</h1><br><form action='retornar.php' method='post'><br><button type='submit' 
		value='inicial' name='bt'>Voltar</button>";
	}
	else {
		echo "<h1>Cpf do cliente nao foi cadastrado!</h1><br><form action='retornar.php' method='post'><br><button type='submit' 
		value='cadastrolocacao' name='bt'>Voltar</button>";
	}

}
else {
	echo "<h1>$mensagem</h1><br><form action='retornar.php' method='post'><br><button type='submit' 
	value='cadastrolocacao' name='bt'>Voltar</button>";
}

?>
