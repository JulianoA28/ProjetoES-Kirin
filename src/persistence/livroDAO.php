<?php

include_once '..\persistence\connection.php';

class livroDAO {
	
	function __construct() {}
	
	//function inserir() {}
	
	function selecionar($campo, $valor, $conn) {
		$sql = "SELECT " . $campo . " FROM livro WHERE Id='$valor'";
		
		$resultado = mysqli_query($conn, $sql);
		
		return $resultado;
		
	}
	
	function locar($valor, $conn) {
		$sql = "UPDATE livro SET Locado=True WHERE Id='$valor'";
		
		if ($conn->query($sql) == TRUE) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

}


?>