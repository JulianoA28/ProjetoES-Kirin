<?php

// Arquivo: rotaCliente.php
// Tem como base receber o cpf de um cliente e enviar os dados para um controller que ira realizar as acoes

// Importando os arquivos
include_once '..\persistence\connection.php';
include_once '..\persistence\clienteDAO.php';
include_once '..\controller\clienteController.php';

// Guardando o cpf
foreach($_POST as $key=>$value);
$cpf = $value;

// Caso as chaves sejam ou de exclusao ou pertecentes a esse bloco 'if' (Botoes Sim ou Nao - Confirmacao da exclusao)
if ($key == 'btx' or $key == 'bts' or $key == 'btn') {
	
	// Se os botoes de Sim ou Nao ainda nao foram pressionados
	if (!isset($_POST['btn']) and !isset($_POST['bts'])) {
		
		// Imprime os botoes na tela
		echo "<form method='post'><p> Tem certeza que deseja excluir o cliente com cpf: $value ?<br>
				<button type='submit' value=$cpf name='bts'>Sim</button>
				<button type='submit' value=$cpf name='btn'>Nao</button></form>";
	}
	
	// Botao Nao
	if (!isset($_POST['btn'])) {}
	// Se for pressionado entrara nesse bloco 'else'
	else {
		// Envia de volta para interface I_ConsultarCliente
		header('Location: ..\view\I_ConsultarCliente.html');
	}
	
	// Botao Sim
	if (!isset($_POST['bts'])) {}
	// Se for pressionado entrara nesse bloco 'else'
	else {
		// Tenta realizar a exclusao e envia para a interface correspondente ao retorno
		if (excluir($cpf)) {
			header('Location: ..\view\IS_ExcluirCliente.html');	
		}
		else {
			header('Location: ..\view\IE_ExcluirCliente.html');
		}
	}
}

// Caso nenhuma botao pertenca ao bloco acima, entrara no bloco abaixo responsavel pela alteracao
else {
	
	// Imprime campos para receber os dados de alteracao
	echo "<h2>Digite somente nos campos que deseja alterar!</h2>
		<form method='post'>Novo nome: <input type='text' name='nnome'><br>Novo email: <input type='email' name='nemail'><br><br>
		<button type='submit' value=$cpf name='btv'>Voltar</button>
		<button type='submit' value=$cpf name='bta'>Alterar</button></form>";
	
	// Botao Voltar
	if (!isset($_POST['btv'])) {}
	// Se for pressionado entrara nesse bloco 'else'
	else {
		// Envia de volta para a interface I_ConsultarCliente
		header('Location: ..\view\I_ConsultarCliente.html');
	}
	
	// Botao Alterar
	if (!isset($_POST['bta'])) {}
	// Se for pressionado entrara nesse bloco 'else'
	else {
		
		// Declarando variaveis
		$nome = null;
		$email = null;
		$certo = false;
		
		// Campo nome - Realizando a checagem se nao esta vazio
		if (!isset($_POST['nnome'])) {}
		// Se nao estiver vazio, realiza a atribuicao a variavel anteriormente declarada neste bloco
		else {
			$certo = true;
			$nome = $_POST['nnome'];
		}
		
		// Campo email - Realizando a checagem se nao esta vazio
		if (!isset($_POST['nemail'])) {}
		// Se nao estiver vazio, realiza a atribuicao a variavel anteriormente declarada neste bloco
		else {
			$certo = true;
			$email = $_POST['nemail'];
		}
		
		// Tenta realizar a alteracao e emite a interface correspondente ao retorno
		if(alterar($cpf, $nome, $email)) {
			header('Location: ..\view\IS_AlterarCliente.html');
		}
		else if ($certo){
			header('Location: ..\view\IE_AlterarCliente.html');
		}
	}
}

?>
