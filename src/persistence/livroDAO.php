<?php

// Arquivo: livroDAO.php
// Arquivo responsavel por acessar os dados do livro no banco de dados

// Importando o arquivo connection
include_once '..\persistence\connection.php';

// Classe
class livroDAO {
	
	function __construct() {}
	
	// Funcao selecionar que recebera:
	// - Campo que representa um atributo da tabela Livro (Nome, Autor, Editora, Id, Locado)
	function selecionar($campo, $valor, $conn) {
		
		// Comando SQL
		$sql = "SELECT " . $campo . " FROM livro WHERE Id='$valor'";
		
		// Resultado da query
		$resultado = mysqli_query($conn, $sql);
		
		return $resultado;
		
	}
	
	// Funcao locar que recebera o id de um livro para alterar seu estado para locado
	function locar($id, $conn) {
		$sql = "UPDATE livro SET Locado=True WHERE Id='$id'";
		
		if ($conn->query($sql) == TRUE) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

}


?>