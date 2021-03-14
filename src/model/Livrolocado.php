<?php

class Livrolocado {
	
	private $idLocacao;
	private $idLivro;
	
	function __construct($vidLocacao, $vidLivro) {
		$this->idLocacao = $vidLocacao;
		$this->idLivro = $vidLivro;
	
	}
	
	// Get Data
	function getIdLocacao() {
		return $this->idLocacao;
	}
	
	// Get Data
	function getIdLivro() {
		return $this->idLivro;
	}
	
}

?>
