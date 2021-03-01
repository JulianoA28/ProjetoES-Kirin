<?php

class Livrolocado {
	
	private $idLocacao;
	private $idLivro;
	private $cpfCliente;
	
	function __construct($vidLocacao, $vidLivro, $vcpfCliente) {
		$this->idLocacao = $vidLocacao;
		$this->idLivro = $vidLivro;
		$this->cpfCliente = $vcpfCliente;
	
	}
	
	// Get Data
	function getIdLocacao() {
		return $this->idLocacao;
	}
	
	// Get Data
	function getIdLivro() {
		return $this->idLivro;
	}
	
	//
	function getCpfCliente() {
		return $this->cpfCliente;
	}
	
}

?>
