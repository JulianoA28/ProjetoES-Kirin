<?php

// Arquivo: rotaLocacao.php
// Tem como base receber o id de uma locacao e enviar os dados para um controller que ira realizar as acoes de exclusao ou alteracao

// Importando os arquivos
include_once '..\persistence\connection.php';
include_once '..\persistence\locacaoDAO.php';
include_once '..\controller\locacaoController.php';
include_once '..\persistence\clienteDAO.php';
include_once '..\persistence\livrolocadoDAO.php';
include_once '..\persistence\livroDAO.php';

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
	
	$locacaoDAO = new locacaoDAO();
	$clienteDAO = new clienteDAO();
	$livrolocadoDAO = new livrolocadoDAO();
	$livroDAO = new livroDAO();
	
	
	// Realizando uma consulta e armazenando o resultado
	$resultLocacao = $locacaoDAO->selecionar("*", "Id", $id, $conexao);
	$rowLocacao = mysqli_fetch_array($resultLocacao);
	
	$resultCliente = $clienteDAO->selecionar("*", "Cpf", $rowLocacao['CpfCliente'], $conexao);
	$rowCliente = mysqli_fetch_array($resultCliente);
	
	// Imprime campos para receber os dados de alteracao
	echo "<h2>Digite somente nos campos que deseja alterar!</h2>
		<body>
		<form action='alterarLocacao.php' method='post' id='form1'>Cliente atual: $rowCliente[Nome] - $rowCliente[Cpf]
		<br>Novo cliente (CPF): <input type='text' name='ncpf' pattern=[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}><br>
		<br> Data limite atual: $rowLocacao[DataLimite]
		<br> Nova data limite: <input type=date name=ndata><br>";
	
	$resultLivrolocado = $livrolocadoDAO->selecionar("*", "IdLocacao", $rowLocacao['Id'], $conexao);
	
	$iLivro = 1;
	while ($rowLivrolocado = mysqli_fetch_array($resultLivrolocado)) {
		
		$idLivro = $rowLivrolocado['IdLivro'];
		$nomeLivro = $livroDAO->selecionar("Nome", $idLivro, $conexao);
		$rowNomeLivro = mysqli_fetch_array($nomeLivro);
		
		// Formato para passar as informacoes do livro
		$opcao = "opcao" . $iLivro;
		$opcaoManter = "manter," . $idLivro;
		$opcaoDevolver = "devolver," . $idLivro;
		echo "<br>$rowNomeLivro[Nome] : $idLivro <input type=text name=$iLivro pattern=[0-9]{6}>&nbsp;&nbsp;&nbsp;&nbsp;
			<select name=$opcao>
				<option value=$opcaoManter>Manter</option>
				<option value=$opcaoDevolver>Devolver</option></select>";
		
		$iLivro = $iLivro + 1;
		//Devolver<input type=radio name=$iLivro+p>";
	
	}
	echo "<div id=box><br></div>";
	echo "<br><button type=button id=add>Adicionar livro</button>";
	echo "<br><br><button type='submit' value=$id name='bta'>Alterar</button></form>";
	echo "<form action='retornar.php' method='post'><button type='submit' value='consultarlocacao' name='bt'>Voltar</button></form>";
	echo "<script src=script.js></script></body>";
		
		
	// Botao Voltar
	if (!isset($_POST['btv'])) {}
	// Se for pressionado entrara nesse bloco 'else'
	else {
		// Envia de volta para a interface I_ConsultarLocacao
		header('Location: ..\view\I_ConsultarLocacao.html');
	}

}

?>