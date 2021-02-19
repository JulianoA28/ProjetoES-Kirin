<?php

// Arquivo: Cliente.php
// Representa o model da tabela Cliente

// Classe
class Cliente {
	
	// Atributos
	private $nome;
	private $email;
	private $cpf;
	
	// Construtor que recebera o nome, email e cpf do cliente
	function __construct($vnome, $vemail, $vcpf) {
		$this->nome = $vnome;
		$this->email = $vemail;
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
	
	// Get CPF
	function getCpf() {
		return $this->cpf;
	}
	
}



?>