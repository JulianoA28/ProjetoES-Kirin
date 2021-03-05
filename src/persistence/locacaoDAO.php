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
		$dataLimite = $locacao->getDataLimite();
		
		// Comando SQL
		$sql = "INSERT INTO locacao(Id, CpfCliente, DataLimite) VALUES (NULL,'$cpfCliente', '$dataLimite')";
		
		// Realizando a query
		if ($conn->query($sql) == TRUE) {
			return $conn->insert_id;
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
		$sql = "SELECT " . $campo1 . " FROM locacao WHERE ". $campo2 . " = '$valor'";
		
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
	function alterar($id, $cpf, $data, $conn) {
		
		// Inicializando o comando SQL
		$sql = "";
		
		$checar = false;

		if ($cpf != null and $data != null) {
			$sql = "UPDATE locacao SET CpfCliente = '$cpf', DataLimite = '$data' WHERE Id='$id'";
			$checar = true;
		}
		else if ($cpf != null) {
			
			$sql = "UPDATE locacao SET CpfCliente = '$cpf' WHERE Id='$id'";
			$checar = true;
		}
		else if ($data != null) {
			
			$sql = "UPDATE locacao SET DataLimite = '$data' WHERE Id='$id'";
			$checar = true;
		}

		if (!$checar) {
			return false;
		}
		else {
			
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
