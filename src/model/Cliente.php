<?php

class Cliente {
	
	private $nome;
	private $email;
	private $cpf;
	
	function __construct($vnome, $vemail, $vcpf) {
		$this->nome = $vnome;
		$this->email = $vemail;
		$this->cpf = $vcpf;
	}
	
	function getNome() {
		return $this->nome;
	}
	
	function getEmail() {
		return $this->email;
	}
	
	function getCpf() {
		return $this->cpf;
	}
	
}



?>