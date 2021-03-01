<?php

// Arquivo Locacao.php
// Representa o model da tabela Locacao

// Classe
class Locacao {
	
	// Atributos
	private $cpfCliente;
	private $dataLimite;
	
	// Construtor que recebe:
	// - O CPF do cliente que realizara a locacao
	// - Uma string que representa o ID de ate 5 livros que serao locados
	// - A data limite
	function __construct($vcpfCliente, $vdataLimite) {
		$this->cpfCliente = $vcpfCliente;
		$this->dataLimite = $vdataLimite;
	
	}
	
	// Get CPF
	function getCpfCliente() {
		return $this->cpfCliente;
	}
	
	// Get Data
	function getDataLimite() {
		return $this->dataLimite;
	}
	
}



?>