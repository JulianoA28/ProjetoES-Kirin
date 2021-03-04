<?php

require_once('..\src\model\Funcionario.php');

	class TestFuncionario extends PHPUnit\Framework\TestCase {
			
		public function test() {
			$nome = "Juliana";
			$email = "juliana@hotmail.com";
			$senha = "12345";
			$cpf = "123.456.789-02";
			
			$obj = new Funcionario($nome, $email, $senha, $cpf);
			
			$this->assertEquals($nome, $obj->getNome(), "assert do nome");
			$this->assertEquals($email, $obj->getEmail(), "assert do email");
			$this->assertEquals($cpf, $obj->getCpf(), "assert do cpf");
		}
		
	}

?>
