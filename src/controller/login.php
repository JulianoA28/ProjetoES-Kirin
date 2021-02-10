<?php

include_once '..\persistence\connection.php';
include_once '..\persistence\funcionarioDAO.php';

$email = $_POST['lemail'];
$senha = $_POST['lsenha'];

if ($email == null or $senha == null) {
	echo "<h1>Email e/ou Senha incorretos!</h1><form action='retornar.php' method='post'><br><button type='submit' value='True' name='bt'>Voltar</button>";
}
else {

	$conexao = new Connection();
	$conexao = $conexao->getConnection();

	$funcionarioDAO = new funcionarioDAO();

	$sql = $funcionarioDAO->selecionarSenhaEmail($email);

	$result = $conexao->query($sql);
	$row = $result->fetch_assoc();
	$senhaDB = $row["Senha"];

	if ($senhaDB == $senha) {
		header('Location: ..\view\I_Inicial.html');
	}
	else {
		echo "<h1>Email e/ou Senha incorretos!</h1><br><form action='retornar.php' method='post'><br><button type='submit' value='True' name='bt'>Voltar</button>";
	}
	
}

?>