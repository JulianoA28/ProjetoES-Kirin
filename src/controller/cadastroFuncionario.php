<?php

include_once '..\persistence\connection.php';
include_once '..\model\Funcionario.php';
include_once '..\persistence\funcionarioDAO.php';

$nome = $_POST['cnome'];
$email = $_POST['cemail'];
$senha = $_POST['csenha'];
$cpf = $_POST['ccpf'];

// Estabelecendo uma conexao
$conexao = new Connection();
$conexao = $conexao->getConnection();

$funcionarioDAO = new funcionarioDAO();

$funcionario = new Funcionario($nome, $email, $senha, $cpf);

// Mensagem apos o cadastro (Sucesso/Erro)
$mensagem = "";

// Checagem para o Cpf e o Email
$cadastradoCpf = $funcionarioDAO->selecionar("Cpf", "Cpf", $cpf, $conexao);
$cadastradoEmail = $funcionarioDAO->selecionar("Email", "Email", $email, $conexao);

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
	echo "<h1>$mensagem</h1><br><form action='retornar.php' method='post'><br><button type='submit' value='cadastrofunc' name='bt'>Voltar</button>";
}

// Caso nem o cpf nem o email tenham sido cadastrados
else {
	
	if ($funcionarioDAO->inserir($funcionario, $conexao)) {
		$mensagem = "Usuário cadastrado com sucesso!";
	}
	else {
		$mensagem = "Erro no cadastro! Tente novamente";
	}
	echo "<h1>$mensagem</h1><br><form action='retornar.php' method='post'><br><button type='submit' value='login' name='bt'>Voltar</button>";
}


?>





