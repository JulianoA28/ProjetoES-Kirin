<?php

require_once('..\..\src\model\Cliente.php');

	class TestCliente extends PHPUnit\Framework\TestCase {
		
		public function test() {
			$nome = "Juliano";
			$email = "juliano@gmail.com";
			$cpf = "123.456.789-01";
			
			$obj = new Cliente($nome, $email, $cpf);
			
			$this->assertEquals($nome, $obj->getNome(), "assert do nome");
			$this->assertEquals($email, $obj->getEmail(), "assert do email");
			$this->assertEquals($cpf, $obj->getCpf(), "assert do cpf");
		}
		
	}

?>
