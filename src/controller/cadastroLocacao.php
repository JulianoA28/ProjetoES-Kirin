<?php

// Arquivo: cadastroLocacao.php
// Tem como finalidade receber as informações de uma locacao e gerenciar o cadastro no banco de dados

// Importando os arquivos
include_once '..\persistence\connection.php';
include_once '..\persistence\locacaoDAO.php';
include_once '..\model\Locacao.php';
include_once '..\persistence\clienteDAO.php';
include_once '..\persistence\livroDAO.php';

// Recebendo os dados de uma locacao
$cpfCliente = $_POST['ccpf'];
$idLivros = $_POST['cidl'];
$dataLimite = $_POST['cdata'];

// Estabelecendo uma conexao
$conexao = new connection();
$conexao = $conexao->getConnection();

// Criando objetos DAO
$locacaoDAO = new locacaoDAO();
$clienteDAO = new clienteDAO();
$livroDAO = new livroDAO();

// Instaciando uma locacao
$locacao = new Locacao($cpfCliente, $idLivros, $dataLimite);

// Variavel para checar validez dos dados
$invalido = false;
// Mensagem de retorno ao usuario
$mensagem = "<br>";

// Fazendo uma consulta no banco de dados para ver se o cpf e valido
$result = $clienteDAO->selecionar("Cpf", "Cpf", $cpfCliente, $conexao);
if (!$result) {
	$invalido = true;
	$mensagem = "Cpf invalido!";
}

// Fazendo uma consulta no banco de dados para ver a validez de cada livro
$listaLivros = explode(",", $idLivros);
foreach($listaLivros as $idLivro) {
	
	// Recebendo o livro
	$result = $livroDAO->selecionar("*", $idLivro, $conexao);
	$row = mysqli_fetch_array($result);
	
	// Caso o livro nao exista
	if ($row == null) {
		$invalido = true;
		$mensagem = $mensagem . "$idLivro invalido!<br>";
	}
	
	// Caso ja esteja locado
	else if ($row['Locado']) {
		$invalido = true;
		$mensagem = $mensagem . "$idLivro ja locado!<br>";
	}

}

// Se os livros estiverem validos
if (!$invalido) {
	
	// Locando os livros
	foreach($listaLivros as $idLivro) {
		
		$livroDAO->locar($idLivro, $conexao);
		
	}
	
	// Mensagem de saida
	$mensagem = "";
	if ($locacaoDAO->inserir($locacao, $conexao)) {
		$mensagem = "Locacao cadastrada com sucesso!";
	}
	else {
		$mensagem = "Erro ao cadastrar locacao!";
	}
	// Imprimindo na tela uma mensagem
	echo "<h1>$mensagem</h1><br><form action='retornar.php' method='post'><br><button type='submit' 
	value='inicial' name='bt'>Voltar</button>";
}
// Caso haja alguma invalidez
else {
	// Imprimindo na tela uma mensagem
	echo "<h1>$mensagem</h1><br><form action='retornar.php' method='post'><br><button type='submit' 
	value='cadastrolocacao' name='bt'>Voltar</button>";
}

?>
