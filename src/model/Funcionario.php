<?php

// Arquivo: Funcionario.php
// Representa o model da tabela Funcionario

// Classe
class Funcionario {
	
	// Atributos
	private $nome;
	private $email;
	private $senha;
	private $cpf;
	
	// Construtor que recebera o nome, email, senha e cpf do funcionario
	function __construct($vnome, $vemail, $vsenha, $vcpf) {
		$this->nome = $vnome;
		$this->email = $vemail;
		$this->senha = $vsenha;
		$this->cpf = $vcpf;
		
	}
	
	// Get Nome
	function getNome() {
		return $this->nome;
	}
	
	// Get Email
	function getEmail() {
		return $this->email;
	}
	
	// Get Senha
	function getSenha() {
		return $this->senha;
	}
	
	// Get CPF
	function getCpf() {
		return $this->cpf;
	}
	
	
}





?>