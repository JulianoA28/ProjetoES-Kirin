<?php

// Arquivo: connection.php
// Arquivo responsavel por estabelecer a conexao com o banco de dados

class connection {
	
	// Atributos - Banco de Dados 'bdfinal'
	private $servername="localhost";
	private	$username="root";
	private	$password="";
	private	$bd="bdfinal";
	private $conn=null;
	
	function __construct(){}
	
	// Funcao para inicializar uma conexao com o Banco de Dados (caso nao tenha sido inicializada)
	// E entao retornar a conexao
	function getConnection() {
		if ($this->conn == null) {

			$this->conn = mysqli_connect($this->servername,$this->username,$this->password,$this->bd);
		}
		
		if (!$this->conn) {
			die("conexão falhou: ". $conn->connect_error);
		}
		
		return $this->conn;
	}
	
}


?>