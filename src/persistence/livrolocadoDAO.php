<?php

include_once 'connection.php';

class livrolocadoDAO {
	
	function __construct() {}
	
	function inserir($livrolocado, $conn) {
		
		$idLocacao = $livrolocado->getIdLocacao();
		$idLivro = $livrolocado->getIdLivro();
		$cpfCliente = $livrolocado->getCpfCliente();
		
		$sql = "INSERT INTO livrolocado(IdLocacao, IdLivro, CpfCliente) VALUES ($idLocacao, $idLivro, '$cpfCliente')";
		
		if ($conn->query($sql) == TRUE) {
			return TRUE;
		}
		return FALSE;
		
	}
	
	function selecionar($campo1, $campo2, $valor, $conn) {
		
		$sql = "SELECT " . $campo1 . " FROM livrolocado WHERE ". $campo2 . " = '$valor'";
		
		$result = $conn->query($sql);
		
		return $result;
		
	}
	
	function excluir($idLivro, $conn) {
		
		$sql = "DELETE FROM livrolocado WHERE IdLivro=$idLivro";
		
		if ($conn->query($sql) == TRUE){
			return TRUE;
		}
		return FALSE;
		
	}
	
}



?>