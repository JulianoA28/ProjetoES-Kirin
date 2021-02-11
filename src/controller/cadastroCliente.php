<?php

include_once '..\persistence\clienteDAO.php';
include_once '..\model\Cliente.php';

$nome = $_POST['cnome'];
$email = $_POST['cemail'];
$cpf = $_POST['ccpf'];

$conexao = new Connection();
$conexao = $conexao->getConnection();

$clienteDAO = new clienteDAO();

$cliente = new Cliente($nome, $email, $cpf);

// Mensagem apos o cadastro (Sucesso/Erro)
$mensagem = "";

// Checagem para o Cpf e o Email
$cadastradoCpf = $clienteDAO->selecionar("Cpf", "Cpf", $cpf, $conexao);
$cadastradoEmail = $clienteDAO->selecionar("Email", "Email", $email, $conexao);

// Se pelo menos um ja foi cadastrado:
if ($cadastradoCpf or $cadastradoEmail) {
	
	// Se os dois ja foram cadastrados
	if ($cadastradoCpf and $cadastradoEmail) {
		$mensagem = "Email e Cpf ja cadastrados!";
	}
	
	// So o Cpf
	else if ($cadastradoCpf) {
		$mensagem = "Cpf ja cadastrado!";
	}
	
	// So o Email
	else {
		$mensagem = "Email ja cadastrado!";
	}
	// Emite com base na variavel mensagem
	echo "<h1>$mensagem</h1><br><form action='retornar.php' method='post'><br><button type='submit' value='cadastrocliente' name='bt'>Voltar</button>";
}

// Caso nem o cpf nem o email tenham sido cadastrados
else {
	
	if ($clienteDAO->inserir($cliente, $conexao)) {
		$mensagem = "Usuário cadastrado com sucesso!";
	}
	else {
		$mensagem = "Erro no cadastro! Tente novamente";
	}
	echo "<h1>$mensagem</h1><br><form action='retornar.php' method='post'><br><button type='submit' value='cadastrocliente' name='bt'>Voltar</button>";
}


?>