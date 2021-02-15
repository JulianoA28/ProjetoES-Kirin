<?php

include_once '..\persistence\connection.php';
include_once '..\persistence\locacaoDAO.php';
include_once '..\persistence\livroDAO.php';

$dados = $_POST['dados'];
$ord = $_POST['ord'];

$conexao = new connection();
$conexao = $conexao->getConnection();

$locacaoDAO = new locacaoDAO();
$livroDAO = new livroDAO();

$result = $locacaoDAO->selecionarTudo($conexao, $dados, $ord);

$qtd = 0;

echo "<style> th, td { border: 1px solid black; border-collapse: collapse; }</style>";
echo "<table><th> Id </th><th> CPF do Cliente </th><th> IDs dos Livros </th><th> Data Limite </th>";
while ($row = mysqli_fetch_array($result)) {
	$qtd = $qtd + 1;
	$id = $row['Id'];
	echo "<tr><td> $row[Id] </td><td> $row[CpfCliente] </td>";
	echo "<td>";
	foreach(explode(",", $row['IdLivro']) as $idLivro) {
		$result2 = $livroDAO->selecionar("Nome", $idLivro, $conexao);
		$row2 = mysqli_fetch_array($result2);
		echo "$row2[Nome] : $idLivro / / ";
	}
	echo "</td>";
	echo "<td> $row[DataLimite] </td>";
	echo "<td><form action='rotaLocacao.php' method='post'><button type='submit' name='btx'
	value='$id'>Excluir</button>";
	echo "<form action='rotaLocacao.php' method='post'><button type='submit' name='bta'
	value='$id'>Alterar</button></td></tr></form></form>";
	
}
echo "</table><br><h4> Quantidade de locacoes: $qtd</h4>";
echo "<form action='retornar.php' method='post'><br><button type='submit' value='consultarlocacao' name='bt'>Voltar</button>";

?>