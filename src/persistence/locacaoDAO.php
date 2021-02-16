<?php

include_once 'connection.php';

class locacaoDAO {
	
	function __construct() {}
	
	function inserir($locacao, $conn) {
		
		$cpfCliente = $locacao->getCpfCliente();
		$idLivros = $locacao->getIdLivros();
		$dataLimite = $locacao->getDataLimite();
		
		$sql = "INSERT INTO locacao(Id, CpfCliente, IdLivro, DataLimite) VALUES (NULL,'$cpfCliente','$idLivros', '$dataLimite')";
		if ($conn->query($sql) == TRUE) {
			return TRUE;
		}
		else {
			return FALSE;
		}
		
	}
	
	
	function selecionar($campo1, $campo2, $valor, $conn) {
		
		$sql = "SELECT " . $campo1 . "FROM locacao WHERE ". $campo2 . " = '$valor'";
		
		$result = $conn->query($sql);
		
		return $result;
		
	}
	
	
	function excluir($id, $conn) {
		
		$sql = "DELETE FROM locacao WHERE Id = '$id'";
		
		if ($conn->query($sql) == TRUE) {
			return TRUE;
		}
		return FALSE;
	
	}
	
	
	function alterar($id, $cpf, $livros, $data, $conn) {
		
		$sql = "UPDATE locacao ";
		
		$checar = false;
		
		$strCpf = "";
		$strIdLivros = "";
		$strData = "";
		
		if ($cpf != null) {
			$strCpf = "SET CpfCliente = '$cpf' ";
			$checar = true;
		}
		else if ($livros != null) {
			$strIdLivros = "SET IdLivro = '$livros' ";
			$checar = true;
		}
		else if ($data != null) {
			$strData = "SET DataLimite = '$data' ";
			$checar = true;
		}
		
		if (!checar) {
			return false;
		}
		else {
			$sql = $sql . $strCpf . $strIdLivros . $strData;
			
			if ($conn->query($sql)) {
				return true;
			}
			return false;
		}
		
	}
	
	
	function selecionarTudo($conn, $column, $ord) {
		$sql = "SELECT * FROM locacao ORDER BY $column $ord";
		
		$result = $conn->query($sql);
		
		return $result;
	
	}
	
	
}


?>