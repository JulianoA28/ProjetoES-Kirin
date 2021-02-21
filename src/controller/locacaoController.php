<?php

// Arquivo: locacaoController.php
// Tem como funcionalidade administrar a exclusao e alteracao de locacoes

// Importando os arquivos
include_once '..\persistence\connection.php';
include_once '..\persistence\locacaoDAO.php';
include_once '..\persistence\livroDAO.php';

// Funcao responsavel por receber o id de uma locacao e exclui-la do banco de dados
function excluir($id) {
	
	// Estabelecendo uma conexao
	$conexao = new connection();
	$conexao = $conexao->getConnection();
	
	// Criando um locacaoDAO
	$locacaoDAO = new locacaoDAO();
	
	//
	$livroDAO = new livroDAO();
	
	//
	$result = $locacaoDAO->selecionar("*", "Id", $id, $conexao);
	$row = mysqli_fetch_array($result);
	
	//
	$listaLivros = explode(",", $row['IdLivro']);
	foreach($listaLivros as $idLivro) {
		$livroDAO->desalocar($idLivro, $conexao);
	}
	
	//
	return $locacaoDAO->excluir($id, $conexao);
	
}

// Funcao responsavel por receber o id de uma locacao e os dados a serem alterados
function alterar($id, $cpf, $livros, $data) {
	
	// Estabelecendo uma conexao
	$conexao = new connection();
	$conexao = $conexao->getConnection();
	
	// Criando um locacaoDAO
	$locacaoDAO = new locacaoDAO();
	
	// Criando um livroDAO
	$livroDAO = new livroDAO();
	
	// Fazendo a alteracao e armazenando a reposta (Bool)
	$alterou = $locacaoDAO->alterar($id, $cpf, $livros, $data, $conexao);
	
	// Se houve a alteracao
	if ($alterou) {
		
		// Se a string de livros nao for null
		if ($livros != null) {
	
			// Recebendo a atual lista (recebida pelo BD com os IDs dos Livros
			$listaLivros = $locacaoDAO->selecionar("idLivro", "Id", $id, $conexao);
			// Separandos a string em um array de IDs
			$listaLivros = explode(",", $listaLivros);
			
			// Separando a nova lista (recebida como parametro - $livros)
			$listaLivros2 = explode(",", $livros);
			
			// Desalocando os livros atuais
			foreach($listaLivros as $idn) {
				$livroDAO->desalocar($idn, $conexao);
			}
			
			// Locando os novos livros
			foreach($listaLivros2 as $idm) {
				$livroDAO->locar($idm, $conexao);
			}
		
		}

	}
	
	return $alterou;
	
}

?>
