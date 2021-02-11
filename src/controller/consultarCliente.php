<?php

include_once '..\persistence\connection.php';
include_once '..\persistence\clienteDAO.php';

$dados = $_POST['dados'];
$ord = $_POST['ord'];

// Estabelecendo uma conexao
$conexao = new Connection();
$conexao = $conexao->getConnection();

$clienteDAO = new clienteDAO();
$result = $clienteDAO->selecionarTudo($conexao, $dados, $ord);
$qtd = 0;

echo "<style> th, td { border: 1px solid black; border-collapse: collapse; }</style>";
echo "<table><th> Nome </th><th> Email </th><th> Cpf </th>";
while ($row = mysqli_fetch_array($result)) {
	$cpf = $row['Cpf'];
	$qtd = $qtd + 1;
	echo "<tr><td> $row[Nome] </td><td> $row[Email] </td><td> $row[Cpf] </td>";
	echo "<td><form action='rota.php' method='post'><button type='submit' name='btx' value='$cpf'>Excluir</button>";
	echo "<form action='rota.php' method='post'><button type='submit' name='bta' value='$cpf'>Alterar</button></td></tr></form></form>";
}

echo "</table><br><h4> Quantidade de clientes: $qtd</h4>";
echo "<form action='retornar.php' method='post'><br><button type='submit' value='consultarcliente' name='bt'>Voltar</button>";

?>