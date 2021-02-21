<?php

// Arquivo: locacaoDAO.php
// Arquivo responsavel por acessar os dados da locacao no banco de dados

// Importando o arquivo connection
include_once 'connection.php';

// Classe
class locacaoDAO {
	
	function __construct() {}
	
	// Funcao inserir que recebera um objeto da classe Locacao e um da classe connection
	function inserir($locacao, $conn) {
		
		// Recebendo os atributos do objeto
		$cpfCliente = $locacao->getCpfCliente();
		$idLivros = $locacao->getIdLivros();
		$dataLimite = $locacao->getDataLimite();
		
		// Comando SQL
		$sql = "INSERT INTO locacao(Id, CpfCliente, IdLivro, DataLimite) VALUES (NULL,'$cpfCliente','$idLivros', '$dataLimite')";
		
		// Realizando a query
		if ($conn->query($sql) == TRUE) {
			return TRUE;
		}
		else {
			return FALSE;
		}
		
	}
	
	// Funcao selecionar:
	// - Primeiro/Segundo parametro: Corresponde a um atributo da tabela (Id, CpfCliente, IdLivro, DataLimite)
	// - Um valor para fazer a comparacao
	// - Um objeto da classe connection
	function selecionar($campo1, $campo2, $valor, $conn) {
		
		// Comando SQL
		$sql = "SELECT " . $campo1 . "FROM locacao WHERE ". $campo2 . " = '$valor'";
		
		// Resultado da Query
		$result = $conn->query($sql);
		
		return $result;
		
	}
	
	// Funcao excluir que recebera o Id da locacao a ser excluida e um objeto da classe connection
	function excluir($id, $conn) {
		
		// Comando SQL
		$sql = "DELETE FROM locacao WHERE Id = '$id'";
		
		// Realizando a query
		if ($conn->query($sql) == TRUE) {
			return TRUE;
		}
		return FALSE;
	
	}
	
	// Funcao alterar que recebera:
	// - Id da locacao que recebera a alteracao
	// - Novo cpf do cliente responsavel pela locacao (caso seja null, nao sera feita a alteracao nesse campo)
	// - Nova string de livros (caso seja null, nao sera feita a alteracao nesse campo)
	// - Nova data limite (caso seja null, nao sera feita alteracao nesse campo)
	// - Um objeto da classe connection
	function alterar($id, $cpf, $livros, $data, $conn) {
		
		// Inicializando o comando SQL
		$sql = "UPDATE locacao ";
		
		// Variavel para checagem
		$checar = false;
		
		// Uma string para cada atributo alteravel
		$strCpf = "";
		$strIdLivros = "";
		$strData = "";
		
		// Checando se o CPF nao e null
		if ($cpf != null) {
			
			// Caso nao, atribui o comando a sua string
			$strCpf = "SET CpfCliente = '$cpf' ";
			$checar = true;
		}
		
		// Checando se os livros nao sao null
		else if ($livros != null) {
			
			// Caso nao, atribui o comando a sua string
			$strIdLivros = "SET IdLivro = '$livros' ";
			$checar = true;
		}
		
		// Checando se a data nao e null
		else if ($data != null) {
			
			// Caso nao, atribui o comando a sua string
			$strData = "SET DataLimite = '$data' ";
			$checar = true;
		}
		
		// Se checar for false, indica que todos parametros de alteracao sao null
		if (!$checar) {
			return false;
		}
		
		// Caso nao
		else {
			
			// Concatena-se todas strings
			$sql = $sql . $strCpf . $strIdLivros . $strData . "WHERE Id='$id'";
			
			// Realizando a query
			if ($conn->query($sql) == TRUE) {
				return true;
			}
			return false;
		}
		
	}
	
	// Funcao que recebera:
	// - Um objeto da classe connection
	// - Duas strings (column / ord) que representam a forma como sera ordenada a busca
	function selecionarTudo($conn, $column, $ord) {
		
		// Comando SQL
		$sql = "SELECT * FROM locacao ORDER BY $column $ord";
		
		// Resultado da query
		$result = $conn->query($sql);
		
		return $result;
	
	}
	
}

?>
