<?php

require_once('..\src\model\Cliente.php');

	class TestCliente extends PHPUnit\Framework\TestCase {
		$nome = "Juliano";
		$email = "juliano@gmail.com";
		$cpf = "123.456.789-01";
		
		public function testNome() {
			$obj = new Cliente($nome, $email, $cpf);
			$this->assertEquals($nome, $obj->getNome(), "assert do nome");
		}
		
		public function testEmail() {		
			$obj = new Cliente($nome, $email, $cpf);
			$this->assertEquals($email, $obj->getEmail(), "assert do email");
		}
		
		public function testCpf() {		
			$obj = new Cliente($nome, $email, $cpf);
			$this->assertEquals($cpf, $obj->getCpf(), "assert do cpf");
			
		}
		
	}

?>
