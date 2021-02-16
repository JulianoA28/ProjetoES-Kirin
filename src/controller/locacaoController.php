<?php

include_once '..\persistence\connection.php';
include_once '..\persistence\locacaoDAO.php';

function excluir($id) {
	
	$conexao = new connection();
	$conexao = $conexao->getConnection();
	
	$locacaoDAO = new locacaoDAO();
	
	return $locacaoDAO->excluir();
	
}


function alterar($id, $cpf, $livros, $data) {
	
	$conexao = new connection();
	$conexao = $conexao->getConnection();
	
	$locacaoDAO = new locacaoDAO();
	
	return $locacaoDAO->alterar($id, $cpf, $livros, $data, $conexao);
	
}






?>