<?php

// Arquivo: clienteController.php
// Tem como funcionalidade administrar a exclusao e alteracao de clientes

include_once '..\persistence\connection.php';
include_once '..\persistence\clienteDAO.php';
include_once '..\persistence\livroDAO.php';
include_once '..\persistence\livrolocadoDAO.php';

// Funcao responsavel por receber o cpf do cliente e realizar a exclusao
function excluir($cpf) {
	
	// Estabelecendo uma conexao
	$conexao = new connection();
	$conexao = $conexao->getConnection();
	
	$livroDAO = new livroDAO();
	
	$livrolocadoDAO = new livrolocadoDAO();
	
	$result = $livrolocadoDAO->selecionar("*", "CpfCliente", $cpf, $conexao);
	while($row = mysqli_fetch_array($result)) {
		
		$idLivro = $row['IdLivro'];
		
		// Desalocando os livros
		$livroDAO->desalocar($idLivro, $conexao);
	
	}
		
	
	// Criando um cliente DAO
	$cDAO = new clienteDAO();
	
	return $cDAO->excluir($cpf, $conexao);
	
}


// Funcao responsavel por receber o cpf do cliente e os dados a serem alterados
function alterar($cpf, $nome, $email) {
	
	// Estabelecendo uma conexao
	$conexao = new connection();
	$conexao = $conexao->getConnection();
	
	// Criando uma cliente DAO
	$cDAO = new clienteDAO();
	
	return $cDAO->alterar($cpf, $nome, $email, $conexao);
	
}

?>
