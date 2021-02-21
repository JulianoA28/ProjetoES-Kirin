<?php

// Arquivo: rotaLocacao.php
// Tem como base receber o id de uma locacao e enviar os dados para um controller que ira realizar as acoes

// Importando os arquivos
include_once '..\persistence\connection.php';
include_once '..\persistence\locacaoDAO.php';
include_once '..\controller\locacaoController.php';

// Guardando o
foreach($_POST as $key=>$value);
$id = $value;

// Caso as chaves sejam ou de exclusao ou pertecentes a esse bloco 'if' (Botoes Sim ou Nao - Confirmacao da exclusao)
if ($key == 'btx' or $key == 'bts' or $key == 'btn') {
	
	// Se os botoes de Sim ou Nao ainda nao foram pressionados
	
	// Imprime os botoes na tela
	if (!isset($_POST['btn']) and !isset($_POST['bts'])) {
		echo "<form method='post'><p> Tem certeza que deseja excluir a locacao com id: $id ?<br>
				<button type='submit' value=$id name='bts'>Sim</button>
				<button type='submit' value=$id name='btn'>Nao</button></form>";
	}
	
	// Botao Nao
	if (!isset($_POST['btn'])) {}
	// Se for pressionado entrara nesse bloco 'else'
	else {
		// Envia de volta para interface I_ConsultarLocacao
		header('Location: ..\view\I_ConsultarLocacao.html');
	}
	
	// Botao Sim
	if (!isset($_POST['bts'])) {}
	// Se for pressionado entrara nesse bloco 'else'
	else {
		// Tenta realizar a exclusao e envia para a interface correspondente ao retorno
		if (excluir($id)) {
			header('Location: ..\view\IS_ExcluirLocacao.html');	
		}
		else {
			header('Location: ..\view\IE_ExcluirLocacao.html');
		}
	}
}

// Caso nenhuma botao pertenca ao bloco acima, entrara no bloco abaixo responsavel pela alteracao
else {
	
	// Estabelecendo uma conexao
	$conexao = new connection();
	$conexao = $conexao->getConnection();
	
	// Criando um locacaoDAO
	$locacaoDAO = new locacaoDAO();
	
	// Realizando uma consulta e armazenando o resultado
	$result = $locacaoDAO->selecionar("*", "Id", $id, $conexao);
	$row = mysqli_fetch_array($result);
	$listaLivros = $row['IdLivro'];
	
	// Imprime campos para receber os dados de alteracao
	echo "<h2>Digite somente nos campos que deseja alterar!</h2>
		<form method='post'>Novo cliente (CPF): <input type='text' name='ncpf'>
		<br> Os IDs dos livros dessa locacao sao: ";
	// Imprimindo os IDs dos livros atuais na locacao
	foreach(explode(",", $row['IdLivro']) as $idLivro) {
		echo "$idLivro - ";
	}
	// Imprimindo os campos restantes e o botoes
	echo "
		<br>Novo(s) livro(s): <input type='text' name='nlivro'>
		<br>Nova data: <input type='date' name='ndata'><br><br>
		<button type='submit' value=$id name='btv'>Voltar</button>
		<button type='submit' value=$id name='bta'>Alterar</button></form>";
		
	// Botao Voltar
	if (!isset($_POST['btv'])) {}
	// Se for pressionado entrara nesse bloco 'else'
	else {
		// Envia de volta para a interface I_ConsultarLocacao
		header('Location: ..\view\I_ConsultarLocacao.html');
	}
	
	// Botao Alterar
	if (!isset($_POST['bta'])) {}
	// Se for pressionado entrara nesse bloco 'else'
	else {
		
		// Declarando variaveis
		$cpf = null;
		$livros = null;
		$data = null;
		$certo = false;
		
		// Campo cpf (do Cliente) - Realizando a checagem se nao esta vazio
		if (!isset($_POST['ncpf'])) {}
		// Se nao estiver vazio, realiza a atribuicao a variavel anteriormente declarada neste bloco
		else {
			$certo = true;
			$cpf = $_POST['ncpf'];
		}
		
		// Campo idLivro - Realizando a checagem se nao esta vazio
		if (!isset($_POST['nlivro'])) {}
		// Se nao estiver vazio, realiza a atribuicao a variavel anteriormente declarada neste bloco
		else {
			$certo = true;
			$livros = $_POST['nlivro'];
		}
		
		// Campo DataLimite - Realizando a checagem se nao esta vazio
		if (!isset($_POST['ndata'])) {}
		// Se nao estiver vazio, realiza a atribuicao a variavel anteriormente declarada neste bloco
		else {
			$certo = true;
			$data = $_POST['ndata'];
		}
		
		// Tenta realizar a alteracao e emite a interface correspondente ao retorno
		if(alterar($id, $cpf, $livros, $data)) {
			header('Location: ..\view\IS_AlterarLocacao.html');
		}
		else if ($certo) {
			header('Location: ..\view\IE_AlterarLocacao.html');
		}
	
	}

}

?>