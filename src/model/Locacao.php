<?php

// Arquivo Locacao.php
// Representa o model da tabela Locacao

class Locacao {
	
	private $cpfCliente;
	private $idLivros;
	private $dataLimite;
	
	function __construct($vcpfCliente, $vidLivros, $vdataLimite) {
		$this->cpfCliente = $vcpfCliente;
		$this->idLivros = $vidLivros;
		$this->dataLimite = $vdataLimite;
	
	}
	
	function getId() {
		return $this->id;
	}
	
	function getCpfCliente() {
		return $this->cpfCliente;
	}
	
	function getIdLivros() {
		return $this->idLivros;
	}
	
	function getDataLimite() {
		return $this->dataLimite;
	}
	
}



?>