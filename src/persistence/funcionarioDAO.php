<?php
// Arquivo: funcionarioDAO
// Tem como responsabilidade fazer as operacoes da tabela Funcionario no Banco de Dados

// Importando o arquivo connection
include_once 'connection.php';

class funcionarioDAO {
	
	function __construct() {}
	
	// Inserir
	function inserir($funcionario, $conn) {
		
		// Recebendo os atributos do funcionario
		$nome = $funcionario->getNome();
		$email = $funcionario->getEmail();
		$senha = $funcionario->getSenha();
		$cpf = $funcionario->getCpf();
		
		// Comando SQL
		$sql = "INSERT INTO funcionario(Nome, Email, Senha, Cpf) VALUES ('$nome','$email','$senha','$cpf')";
		
		// Checando se houve a insercao
		if ($conn->query($sql) == TRUE) {
			return TRUE;
		}
		else {
			return FALSE;
		}
		
	}
	
	// Selecionar utilizado somente para averiguacao do Cadastro
	function selecionar($campo1, $campo2, $valor, $conn) {
		$sql = "SELECT " . $campo1 . " FROM funcionario WHERE " . $campo2 . " = '$valor'";
		
		$resultado = mysqli_query($conn, $sql);
		
		// Checando se ja ha alguem com esse valor (Email/Cpf) cadastro no BD.
		if (mysqli_num_rows($resultado)==1) { 
			return True;
		}
		return False;
		
	}
	
	// Retornar a senha para verificacao de Login
	function verificarSenha($email, $senha, $conn) {
		$sql = "SELECT Senha FROM funcionario WHERE Email = '$email'";
		
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$senhaDB = $row["Senha"];
		
		// Checando se a senha cadastrada com o Email recebido é igual a senha recebida.
		if ($senhaDB == $senha) {
			return True;
		}
		return False;
	}
	
	// Funcao getAll para retornar todo conteudo da tabela Funcionario
	function getAll($conn) {
		
		// Comando SQL
		$sql = "SELECT * FROM funcionario WHERE 1";
		
		// Resultado da query
		$result = $conn->query($sql);
		
		return $result;
	
	}
	
	// Funcao excluir que recebera o cpf do funcionario a ser excluido e um objeto da classe connection
	function excluir($cpf, $conn) {
		
		// Comando SQL
		$sql = "DELETE FROM funcionario WHERE Cpf = '$cpf'";
		
		if ($conn->query($sql) == TRUE) {
			echo "Funcionario excluido com sucesso!";
		}
		else {
			echo "Erro ao excluir";
		}
		
	}
		
}

?>
