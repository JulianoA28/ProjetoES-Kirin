<?php

// Arquivo Locacao.php
// Representa o model da tabela Locacao

// Classe
class Locacao {
	
	// Atributos
	private $cpfCliente;
	private $idLivros;
	private $dataLimite;
	
	// Construtor que recebe:
	// - O CPF do cliente que realizara a locacao
	// - Uma string que representa o ID de ate 5 livros que serao locados
	// - A data limite
	function __construct($vcpfCliente, $vidLivros, $vdataLimite) {
		$this->cpfCliente = $vcpfCliente;
		$this->idLivros = $vidLivros;
		$this->dataLimite = $vdataLimite;
	
	}
	
	// Get ID
	function getId() {
		return $this->id;
	}
	
	// Get CPF
	function getCpfCliente() {
		return $this->cpfCliente;
	}
	
	// Get ID dos Livros
	function getIdLivros() {
		return $this->idLivros;
	}
	
	// Get Data
	function getDataLimite() {
		return $this->dataLimite;
	}
	
}



?>