<?php

// Arquivo: locacaoController.php
// Tem como funcionalidade administrar a exclusao e alteracao de locacoes

// Importando os arquivos
include_once '..\persistence\connection.php';
include_once '..\persistence\locacaoDAO.php';
include_once '..\persistence\livroDAO.php';
include_once '..\persistence\livrolocadoDAO.php';

// Funcao responsavel por receber o id de uma locacao e exclui-la do banco de dados
function excluir($id) {
	
	// Estabelecendo uma conexao
	$conexao = new connection();
	$conexao = $conexao->getConnection();
	
	$livroDAO = new livroDAO();
	// Criando um locacaoDAO
	$locacaoDAO = new locacaoDAO();
	
	$livrolocadoDAO = new livrolocadoDAO();
	
	$resultLivrolocado = $livrolocadoDAO->selecionar("*", "IdLocacao", $id, $conexao);
	
	if ($resultLivrolocado) {
		while ($rowLivrolocado = mysqli_fetch_array($resultLivrolocado)) {
			
			$livroDAO->desalocar($rowLivrolocado['IdLivro'], $conexao);
			
		}
		return $locacaoDAO->excluir($id, $conexao);
		
	}
	
	//
	return false;
	
}

function checarData($data1, $data2) {
	$date1 = new DateTime($data1);
	$date2 = new DateTime($data2);
	
	if ($date1 < $date2) {
		return true;
	}
	return false;

}

?>
