<?php

// Arquivo: clienteController.php
// Tem como funcionalidade administrar a exclusao e alteracao de clientes

include_once '..\persistence\connection.php';
include_once '..\persistence\clienteDAO.php';

// Funcao responsavel por receber o cpf do cliente e realizar a exclusao
function excluir($cpf) {
	
	// Estabelecendo uma conexao
	$conexao = new connection();
	$conexao = $conexao->getConnection();
	
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
