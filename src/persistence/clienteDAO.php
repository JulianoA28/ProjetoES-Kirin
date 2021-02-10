<?php

class clienteDAO {
	
	function __construct() {}
	
	function inserir($cliente) {
		
		$nome = $cliente->getNome();
		$email = $cliente->getEmail();
		$senha = $cliente->getSenha();
		$cpf = $cliente->getCpf();
		
		$sql = "INSERT INTO cliente(Nome, Email, Senha, Cpf) VALUES ('$nome','$email','$senha','$cpf')";
		
	}
	
	function alterar($campo, $valor, $cpf) {
		
		$sql = "UPDATE cliente SET '$campo'='$valor' WHERE Cpf='$cpf'";
		
		return $sql;
		
	}
	
	function excluir($cpf) {
		
		$sql = "DELETE FROM cliente WHERE Cpf='$cpf'";
		
		return $sql;
		
	}
	
	
}


?>