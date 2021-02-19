<?php

// Arquivo: consultarCliente.php
// Tem como funcionalidade mostrar dados de todos os clientes cadastrados

// Importando os arquivos
include_once '..\persistence\connection.php';
include_once '..\persistence\clienteDAO.php';

// Recebendo os dados de ordenacao
$dados = $_POST['dados'];
$ord = $_POST['ord'];

// Estabelecendo uma conexao
$conexao = new Connection();
$conexao = $conexao->getConnection();

// Criando um cliente DAO
$clienteDAO = new clienteDAO();

// Recebendo todos os dados da tabela cliente
$result = $clienteDAO->selecionarTudo($conexao, $dados, $ord);

// Variavel para armazenar a quantidade de clientes
$qtd = 0;

// Imprimindo o inicio da tabela
echo "<style> th, td { border: 1px solid black; border-collapse: collapse; }</style>";
echo "<table><th> Nome </th><th> Email </th><th> Cpf </th>";

// Para cada linha na tabela
while ($row = mysqli_fetch_array($result)) {
	
	// Guardando o CPF
	$cpf = $row['Cpf'];
	
	// Aumentando a quantidade
	$qtd = $qtd + 1;
	
	// Imprimindo os dados
	echo "<tr><td> $row[Nome] </td><td> $row[Email] </td><td> $row[Cpf] </td>";
	
	// Imprimindo os botoes de excluir e alterar, alem de passar o cpf como valor
	echo "<td><form action='rotaCliente.php' method='post'><button type='submit' name='btx' value='$cpf'>Excluir</button>";
	echo "<form action='rotaCliente.php' method='post'><button type='submit' name='bta' value='$cpf'>Alterar</button></td></tr></form></form>";
}

// Imprimindo a quantidade de clientes e um botao para voltar
echo "</table><br><h4> Quantidade de clientes: $qtd</h4>";
echo "<form action='retornar.php' method='post'><br><button type='submit' value='consultarcliente' name='bt'>Voltar</button>";

?>
