<?php
// Arquivo: retornar
// Tem a funcionalidade de redirecionar o usuário de acordo com o resultado do cadastro

$c = $_POST['bt'];

if ($c == "True") {
	header('Location: ..\view\I_Login.html');
}
else {
	header('Location: ..\view\I_Cadastro.html');
}

?>
