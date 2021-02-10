<?php

class funcionarioDAO {
	
	function __construct() {}
	
	// Inserir
	function inserir($funcionario) {
		
		$nome = $funcionario->getNome();
		$email = $funcionario->getEmail();
		$senha = $funcionario->getSenha();
		$cpf = $funcionario->getCpf();
		
		$sql = "INSERT INTO funcionario(Nome, Email, Senha, Cpf) VALUES ('$nome','$email','$senha','$cpf')";
	
		return $sql;
		
	}
	
	// Selecionar a senha com base no email
	function selecionarSenhaEmail($valor) {
		$sql = "SELECT Senha FROM funcionario WHERE Email = '$valor'";
		
		return $sql;
	}
	
	// Selecionar o cpf com base no cpf
	function selecionarCpfCpf($valor) {
		$sql = "SELECT Cpf FROM funcionario WHERE Cpf = '$valor'";
		
		return $sql;
	}
	
	// Selecionar o email com base no email
	function selecionarEmailEmail($valor) {
		$sql = "SELECT Email FROM funcionario WHERE Email = '$valor'";
		
		return $sql;
	}

}

?>