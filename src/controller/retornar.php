<?php

$c = $_POST['bt'];

if ($c == "True") {
	header('Location: ..\view\I_Login.html');
}
else {
	header('Location: ..\view\I_Cadastro.html');
}

?>