<?php

include_once '..\persistence\connection.php';
include_once '..\persistence\clienteDAO.php';
include_once '..\controller\clienteController.php';

foreach($_POST as $key=>$value);
$cpf = $value;

if ($key == 'btx' or $key == 'bts' or $key == 'btn') {
	if (!isset($_POST['btn']) and !isset($_POST['bts'])) {
		echo "<form method='post'><p> Tem certeza que deseja excluir o cliente com cpf: $value ?<br>
				<button type='submit' value=$cpf name='bts'>Sim</button>
				<button type='submit' value=$cpf name='btn'>Nao</button></form>";
	}
	if (!isset($_POST['btn'])) {}
	else {
		header('Location: ..\view\I_ConsultarCliente.html');
	}
	if (!isset($_POST['bts'])) {}
	else {
		if (excluir($cpf)) {
			header('Location: ..\view\IS_ExcluirCliente.html');	
		}
		else {
			header('Location: ..\view\IE_ExcluirCliente.html');
		}
	}
}
else {

	echo "<h2>Digite somente nos campos que deseja alterar!</h2>
		<form method='post'>Novo nome: <input type='text' name='nnome'><br>Novo email: <input type='email' name='nemail'><br><br>
		<button type='submit' value=$cpf name='btv'>Voltar</button>
		<button type='submit' value=$cpf name='bta'>Alterar</button></form>";

	if (!isset($_POST['btv'])) {}
	else {
		header('Location: ..\view\I_ConsultarCliente.html');
	}
	if (!isset($_POST['bta'])) {}
	else {
		$nome = null;
		$email = null;
		$certo = false;
		if (!isset($_POST['nnome'])) {}
		else {
			$certo = true;
			$nome = $_POST['nnome'];
		}
		if (!isset($_POST['nemail'])) {}
		else {
			$certo = true;
			$email = $_POST['nemail'];
		}
		
		if(alterar($cpf, $nome, $email)) {
			header('Location: ..\view\IS_AlterarCliente.html');
		}
		else if ($certo){
			header('Location: ..\view\IE_AlterarCliente.html');
		}
	}
	
}


?>