<?php
// Arquivo: Cliente
// Responsável por receber os dados do Cliente no cadastro

class Cliente {
	
	private $nome;
	private $email;
	private $senha;
	private $cpf;
	
	function __construct($vnome, $vemail, $vsenha, $vcpf) {
		$this->nome = $vnome;
		$this->email = $vemail;
		$this->senha = $vsenha;
		$this->cpf = $vcpf;
		
	}
	
	function getNome() {
		return $this->nome;
	}
	
	function getEmail() {
		return $this->email;
	}
	
	function getSenha() {
		return $this->senha;
	}
	
	function getCpf() {
		return $this->cpf;
	}
	
	function consultar() {
		return "Nome: '$this->nome' \nEmail: '$this->email'";
	}
	
}



?>
