<?php

include_once 'connection.php';

class clienteDAO {
	
	function __construct() {}
	
	//
	function inserir($cliente, $conn) {
		
		$nome = $cliente->getNome();
		$email = $cliente->getEmail();
		$cpf = $cliente->getCpf();
		
		$sql = "INSERT INTO cliente(Nome, Email, Cpf) VALUES ('$nome','$email','$cpf')";
		
		if ($conn->query($sql) == TRUE) {
			return TRUE;
		}
		else {
			return FALSE;
		}
		
	}
	
	//
	function selecionar($campo1, $campo2, $valor, $conn) {
		$sql = "SELECT " . $campo1 . " FROM cliente WHERE " . $campo2 . " = '$valor'";
		
		$resultado = mysqli_query($conn, $sql);
		
		// Checando se ja ha alguem com esse valor (Email/Cpf) cadastro no BD.
		if (mysqli_num_rows($resultado)==1) { 
			return True;
		}
		return False;
		
	}
	
	//
	function selecionarTudo($conn, $column, $ord) {
		$sql = "SELECT * FROM cliente ORDER BY $column $ord";
		
		$result = $conn->query($sql);
		
		return $result;
	
	}
	
	//
	function excluir($cpf, $conn) {
		$sql = "DELETE FROM cliente WHERE Cpf = '$cpf'";
		
		if ($conn->query($sql) == TRUE) {
			return TRUE;
		}
		else {
			return FALSE;
		}
		
	}
	
	//
	function alterar($cpf, $nome, $email, $conn) {
		
		$sql = null;
		
		if ($nome != null and $email != null) {
			$sql = "UPDATE cliente SET Nome='$nome', Email='$email' WHERE Cpf='$cpf'";
		}
		else if ($nome != null) {
			$sql = "UPDATE cliente SET Nome='$nome' WHERE Cpf='$cpf'";
		}
		else if ($email != null) {
			$sql = "UPDATE cliente SET Email='$email' WHERE Cpf='$cpf'";
		}
		
		if ($sql != null) {
			if ($conn->query($sql) == TRUE) {
				return TRUE;
			}
		}
		return FALSE;
		
		
	}
	
	
	
}


?>