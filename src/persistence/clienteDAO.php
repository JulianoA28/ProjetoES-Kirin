<?php

// Arquivo: clienteDAO.php
// Arquivo responsavel por acessar os dados do cliente no banco de dados

// Importando o arquivo connection
include_once 'connection.php';

// Classe
class clienteDAO {
	
	function __construct() {}
	
	// Funcao inserir que recebera um objeto da classe Cliente e um da classe connection
	function inserir($cliente, $conn) {
		
		// Recebendo os atributos do objeto
		$nome = $cliente->getNome();
		$email = $cliente->getEmail();
		$cpf = $cliente->getCpf();
		
		// Comando SQL
		$sql = "INSERT INTO cliente(Nome, Email, Cpf) VALUES ('$nome','$email','$cpf')";
		
		// Realizando a query
		if ($conn->query($sql) == TRUE) {
			return TRUE;
		}
		else {
			return FALSE;
		}
		
	}
	
	// Funcao selecionar:
	// - Primeiro/Segundo parametro: Corresponde a um atributo da tabela (Nome, Email, Cpf)
	// - Um valor para fazer a comparacao
	// - Um objeto da classe connection
	function selecionar($campo1, $campo2, $valor, $conn) {
		
		// Comando SQL
		$sql = "SELECT " . $campo1 . " FROM cliente WHERE " . $campo2 . " = '$valor'";
		
		// Resultado da query
		$resultado = mysqli_query($conn, $sql);
		
		// Checando se ja ha alguem com esse valor (Email/Cpf) cadastro no BD.
		if (mysqli_num_rows($resultado)==1) { 
			return True;
		}
		return False;
		
	}
	
	// Funcao que recebera:
	// - Um objeto da classe connection
	// - Duas strings (column / ord) que representam a forma como sera ordenada a busca
	function selecionarTudo($conn, $column, $ord) {
		
		// Comando SQL
		$sql = "SELECT * FROM cliente ORDER BY $column $ord";
		
		// Resultado da query
		$result = $conn->query($sql);
		
		return $result;
	
	}
	
	// Funcao excluir que recebera um cpf e um objeto da classe connection
	function excluir($cpf, $conn) {
		
		// Comando SQL
		$sql = "DELETE FROM cliente WHERE Cpf = '$cpf'";
		
		// Realizando a query
		if ($conn->query($sql) == TRUE) {
			return TRUE;
		}
		else {
			return FALSE;
		}
		
	}
	
	// Funcao alterar que recebera:
	// - CPF do cliente que recebera a alteracao
	// - Novo nome para realizar a substituicao (caso seja null, nao sera feita a alteracao nesse campo)
	// - Novo email para realizar a substituicao (caso seja null, nao sera feita a alteracao nesse campo)
	// - Um objeto da classe connection
	function alterar($cpf, $nome, $email, $conn) {
		
		// Incializando o comando SQL
		$sql = null;
		
		// Checando os parametros (Se os dois nao sao null)
		if ($nome != null and $email != null) {
			$sql = "UPDATE cliente SET Nome='$nome', Email='$email' WHERE Cpf='$cpf'";
		}
		
		// Checando os parametros (Se so o nome nao e null)
		else if ($nome != null) {
			$sql = "UPDATE cliente SET Nome='$nome' WHERE Cpf='$cpf'";
		}
		
		// Checando os parametros (Se so o email nao e null)
		else if ($email != null) {
			$sql = "UPDATE cliente SET Email='$email' WHERE Cpf='$cpf'";
		}
		
		// Se $sql nao for null, realiza a query
		if ($sql != null) {
			if ($conn->query($sql) == TRUE) {
				return TRUE;
			}
		}
		return FALSE;
		
	}
	
}

?>
