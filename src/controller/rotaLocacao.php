<?php

include_once '..\persistence\connection.php';
include_once '..\persistence\locacaoDAO.php';
include_once '..\controller\locacaoController.php';

foreach($_POST as $key=>$value);
$id = $value;

if ($key == 'btx' or $key == 'bts' or $key == 'btn') {
	if (!isset($_POST['btn']) and !isset($_POST['bts'])) {
		echo "<form method='post'><p> Tem certeza que deseja excluir a locacao com id: $id ?<br>
				<button type='submit' value=$id name='bts'>Sim</button>
				<button type='submit' value=$id name='btn'>Nao</button></form>";
	}
	if (!isset($_POST['btn'])) {}
	else {
		header('Location: ..\view\I_ConsultarLocacao.html');
	}
	if (!isset($_POST['bts'])) {}
	else {
		if (excluir($id)) {
			header('Location: ..\view\IS_ExcluirLocacao.html');	
		}
		else {
			header('Location: ..\view\IE_ExcluirLocacao.html');
		}
	}
}
else {
	$conexao = new connection();
	$conexao = $conexao->getConnection();
	
	$locacaoDAO = new locacaoDAO();
	
	$result = $locacaoDAO->selecionar("IdLivro", "Id", $id, $conexao);
	$row = mysqli_fetch_array($result);
	$listaLivros = $row['IdLivro'];
	
	
	echo "<h2>Digite somente nos campos que deseja alterar!</h2>
		<form method='post'>Novo cliente (CPF): <input type='text' name='ncpf'>
		<br> Os IDs dos livros dessa locacao sao: ";
	foreach(explode(",", $row['IdLivro']) as $idLivro) {
		echo "$idLivro - ";
	}
	echo "
		<br>Novo(s) livro(s): <input type='text' name='nlivro'>
		<br>Nova data: <input type='date' name='ndata'><br><br>
		<button type='submit' value=$id name='btv'>Voltar</button>
		<button type='submit' value=$id name='bta'>Alterar</button></form>";
		
	if (!isset($_POST['btv'])) {}
	else {
		header('Location: ..\view\I_ConsultarLocacao.html');
	}
	if (!isset($_POST['bta'])) {}
	else {
		$cpf = null;
		$livros = null;
		$data = null;
		$certo = false;
		if (!isset($_POST['ncpf'])) {}
		else {
			$certo = true;
			$cpf = $_POST['ncpf'];
		}
		if (!isset($_POST['nemail'])) {}
		else {
			$certo = true;
			$email = $_POST['nlivro'];
		}
		if (!isset($_POST['ndata'])) {}
		else {
			$certo = true;
			$data = $_POST['ndata'];
		}
		
		if(alterar($id, $cpf, $livros, $data)) {
			header('Location: ..\view\IS_AlterarLocacao.html');
		}
		else if ($certo) {
			header('Location: ..\view\IE_AlterarLocacao.html');
		}
	
	}

}

?>