<?php
// Arquivo: login
// Tem como responsabilidade realizar o login dos funcionarios

// Importando os arquivos
include_once '..\persistence\connection.php';
include_once '..\persistence\funcionarioDAO.php';

// Recebendo os dados de login (Email e Senha)
$email = $_POST['lemail'];
$senha = $_POST['lsenha'];

// Estabelecendo uma conexao
$conexao = new Connection();
$conexao = $conexao->getConnection();

// Criando o DAO
$funcionarioDAO = new funcionarioDAO();

// Realizando a checagem dos dados recebidos
$checagem = $funcionarioDAO->verificarSenha($email, $senha, $conexao);

// Se estiver valida
if ($checagem) {
	// Caso esteja correta, envia para a pagina Inicial
	header('Location: ..\view\I_Inicial.html');
}
else {
	// Caso nao emite um erro
	echo "<h1>Email e/ou Senha incorretos!</h1><br><form action='retornar.php' method='post'><br><button type='submit' value='login' name='bt'>Voltar</button>";
}

?>
