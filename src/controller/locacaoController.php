<?php

// Arquivo: locacaoController.php
// Tem como funcionalidade administrar a exclusao e alteracao de locacoes

// Importando os arquivos
include_once '..\persistence\connection.php';
include_once '..\persistence\locacaoDAO.php';

// Funcao responsavel por receber o id de uma locacao e exclui-la do banco de dados
function excluir($id) {
	
	// Estabelecendo uma conexao
	$conexao = new connection();
	$conexao = $conexao->getConnection();
	
	// Criando um locacaoDAO
	$locacaoDAO = new locacaoDAO();
	
	return $locacaoDAO->excluir();
	
}

// Funcao responsavel por receber o id de uma locacao e os dados a serem alterados
function alterar($id, $cpf, $livros, $data) {
	
	// Estabelecendo uma conexao
	$conexao = new connection();
	$conexao = $conexao->getConnection();
	
	// Criando um locacaoDAO
	$locacaoDAO = new locacaoDAO();
	
	return $locacaoDAO->alterar($id, $cpf, $livros, $data, $conexao);
	
}






?>