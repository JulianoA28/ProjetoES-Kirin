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

$string = "";
$certo = True;

// Checagem para o CPF!
$sql = $funcionarioDAO->selecionarCpfCpf($cpf);
$resultado = mysqli_query($conexao, $sql);
if (mysqli_num_rows($resultado)==1) { 
	$string = "Cpf ja cadastrado!";
	$certo = False;
}

// Checagem para o Email!
$sql = $funcionarioDAO->selecionarEmailEmail($email);
$resultado = mysqli_query($conexao, $sql);
if (mysqli_num_rows($resultado)==1) {
	if (!$certo) {
		$string = "Cpf e Email ja cadastrados!";
	}
	else {
		$string = "Email ja cadastrado!";
		$certo = False;
	}
	
}

// Se nem o cpf nem o email foram cadastrados no banco de dados, entao esta tudo correto:
if ($certo) {
	
	$sql = $funcionarioDAO->inserir($funcionario);

	if ($conexao->query($sql) == TRUE) {
		$string = "Usuário cadastrado";
	}
	else {
		$string = "Erro no cadastro: <br>".$conexao->error;
	}
	
	echo "<h1>'$string'</h1><br><form action='retornar.php' method='post'><br><button type='submit' value='True' name='bt'>Voltar</button>";
	
}
else {
	echo "<h1>'$string'</h1><br><form action='retornar.php' method='post'><br><button type='submit' value='False' name='bt'>Voltar</button>";
}

?>





