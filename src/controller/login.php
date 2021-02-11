<?php
// Arquivo: login
// Tem como responsabilidade realizar o login dos funcionarios

include_once '..\persistence\connection.php';
include_once '..\persistence\funcionarioDAO.php';

// Recebendo os dados de login (Email e Senha)
$email = $_POST['lemail'];
$senha = $_POST['lsenha'];

// Checando se nenhum campo esta vazio
if ($email == null or $senha == null) {
	echo "<h1>Email e/ou Senha incorretos!</h1><form action='retornar.php' method='post'><br><button type='submit' value='login' name='bt'>Voltar</button>";
}
else {
	
	// Criando uma conexao
	$conexao = new Connection();
	$conexao = $conexao->getConnection();
	
	// Criando o DAO
	$funcionarioDAO = new funcionarioDAO();

	$checagem = $funcionarioDAO->verificarSenha($email, $senha, $conexao);
	
	// Realizando a checagem
	if ($checagem) {
		// Caso esteja correta, envia para a pagina Inicial
		header('Location: ..\view\I_Inicial.html');
	}
	else {
		// Caso nao emite um erro
		echo "<h1>Email e/ou Senha incorretos!</h1><br><form action='retornar.php' method='post'><br><button type='submit' value='login' name='bt'>Voltar</button>";
	}
	
}

?>