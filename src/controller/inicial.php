<?php

$tipo = $_POST['bt'];

?>

<html>
<form action="t.php", method="post">
	<h2> Digite o CPF do Cliente </h2>
	<input type="text" name="ccpf" maxlength="50"> <br><br>
	<button type="submit" value="<?=$tipo?>" name="bt1"> Selecionar </button>
</form>
</html>