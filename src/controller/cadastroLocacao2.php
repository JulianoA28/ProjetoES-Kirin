<?php

include_once '..\persistence\connection.php';
include_once '..\persistence\locacaoDAO.php';
include_once '..\persistence\livroDAO.php';
include_once '..\persistence\livrolocadoDAO.php';
include_once '..\model\Locacao.php';
include_once '..\model\Livrolocado.php';

// Criar uma locacao e pegar o seu id

$conexao = new connection();
$conexao = $conexao->getConnection();

$locacaoDAO = new locacaoDAO();

$livroDAO = new livroDAO();

$certo = true;
$mensagemErro = "";

$num = $_POST['num'];
// Checagem dos livros
for ($i = 1; $i <= $num; $i++) {
	$idLivro = $_POST[$i];
	
	$result = $livroDAO->selecionar("*", $idLivro, $conexao);
	$row = mysqli_fetch_array($result);
	if ($row == null) {
		$certo = false;
		$mensagemErro = $mensagemErro . "$idLivro e invalido!&nbsp;";
	}
	else if ($row['Locado']) {
		$certo = false;
		$mensagemErro = $mensagemErro . "$idLivro ja esta locado!&nbsp;";
	}
	
}

if ($certo) {
	
	$erro = false;
	
	$livrolocadoDAO = new livrolocadoDAO();

	$cpfCliente = $_POST['ccpf'];
	$data = $_POST['cdata'];
	$locacao = new Locacao($cpfCliente, $data);
	$idLocacao = $locacaoDAO->inserir($locacao, $conexao);

	for ($i = 1; $i <= $num; $i++) {
		
		$idLivro = $_POST[$i];
		
		$livrolocado = new Livrolocado($idLocacao, $idLivro, $cpfCliente);
		
		if ($livrolocadoDAO->inserir($livrolocado, $conexao)) {
			echo "<p>$idLivro foi cadastrado com sucesso!";
			
			$livroDAO->locar($idLivro, $conexao);
			
		}
		else {
			echo "<p>$idLivro nao foi cadastrado!";
		}
		
	}	
	
}
else {
	echo "<h2> Por favor tente cadastrar novamente! </h2>";
	echo "$mensagemErro";
}
echo "<form action='retornar.php' method='post'><br><button type='submit' value='inicial' name='bt'>Voltar</button>";


?>
