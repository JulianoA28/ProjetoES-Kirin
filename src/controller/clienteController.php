<?php

include_once '..\persistence\connection.php';
include_once '..\persistence\clienteDAO.php';

function excluir($cpf) {

	$conexao = new connection();
	$conexao = $conexao->getConnection();

	$cDAO = new clienteDAO();

	return $cDAO->excluir($cpf, $conexao);
	
}

function alterar($cpf, $nome, $email) {
	
	$conexao = new connection();
	$conexao = $conexao->getConnection();
	
	$cDAO = new clienteDAO();
	
	return $cDAO->alterar($cpf, $nome, $email, $conexao);
	
}


?>