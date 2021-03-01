<?php

// Arquivo: consultarLocacao.php
// Tem como funcionalidade mostrar dados de todas as locaoes cadastradas

// Importando os arquivos
include_once '..\persistence\connection.php';
include_once '..\persistence\locacaoDAO.php';
include_once '..\persistence\livroDAO.php';
include_once '..\persistence\livrolocadoDAO.php';

// Recebendo os dados de ordenacao
$dados = $_POST['dados'];
$ord = $_POST['ord'];

// Estabelecendo uma conexao
$conexao = new connection();
$conexao = $conexao->getConnection();

// Criando objetos DAO
$locacaoDAO = new locacaoDAO();
$livroDAO = new livroDAO();
$livrolocadoDAO = new livrolocadoDAO();

// Recebendo todos os dados da tabela locacao
$result = $locacaoDAO->selecionarTudo($conexao, $dados, $ord);

// Variavel para armazenar a quantidade de locacoes
$qtd = 0;

// Imprimindo o inicio da tabela
echo "<style> th, td { border: 1px solid black; border-collapse: collapse; }</style>";
echo "<table><th> Id </th><th> CPF do Cliente </th><th> Livros </th><th> Data Limite </th>";

// Para cada linha na tabela
while ($row = mysqli_fetch_array($result)) {
	
	// Guardando o ID
	$id = $row['Id'];
	
	// Aumentando a quantidade
	$qtd = $qtd + 1;
	
	// Imprimindo o ID e o CPF
	echo "<tr><td> $row[Id] </td><td> $row[CpfCliente] </td>";
	echo "<td>";
	
	$result2 = $livrolocadoDAO->selecionar("*", "IdLocacao", $id, $conexao);
	
	while ($row2 = mysqli_fetch_array($result2)) {
		
		$idLivro = $row2['IdLivro'];
		$result3 = $livroDAO->selecionar("Nome", $idLivro, $conexao);
		$row3 = mysqli_fetch_array($result3);
		echo "$row3[Nome]: $idLivro &nbsp;";
		
	}
	
	echo "</td>";
	
	// Imprimindo a Data Limite
	echo "<td> $row[DataLimite] </td>";
	
	// Imprimindo os botoes de excluir e alterar, alem de passar o id como valor
	echo "<td><form action='rotaLocacao.php' method='post'><button type='submit' name='btx'
	value='$id'>Excluir</button>";
	echo "<form action='rotaLocacao.php' method='post'><button type='submit' name='bta'
	value='$id'>Alterar</button></td></tr></form></form>";
	
}

// Imprimindo a quantidade de locacoes e um botao para voltar
echo "</table><br><h4> Quantidade de locacoes: $qtd</h4>";
echo "<form action='retornar.php' method='post'><br><button type='submit' value='consultarlocacao' name='bt'>Voltar</button>";

?>
