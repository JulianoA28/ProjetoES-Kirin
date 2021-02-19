<?php

// Arquivo: retornar
// Com base nos parametros ("value" de um botao) ele redireciona para uma certa pagina.

// Recebendo o valor do botao
$valor = $_POST["bt"];

// Redirecionando com base no valor
switch ($valor) {
	case "login":
		header('Location: ..\view\I_Login.html');
		break;
		
	case "cadastrofunc":
		header('Location: ..\view\I_CadastroFuncionario.html');
		break;
		
	case "inicial":
		header('Location: ..\view\I_Inicial.html');
		break;
		
	case "cadastrocliente":
		header('Location: ..\view\I_CadastrarCliente.html');
		break;
		
	case "consultarcliente":
		header('Location: ..\view\I_ConsultarCliente.html');
		break;
	
	case "cadastrolocacao":
		header('Location: ..\view\I_CadastrarLocacao.html');
		break;
		
	case "consultarlocacao":
		header('Location: ..\view\I_ConsultarLocacao.html');
		break;
		
}

?>
