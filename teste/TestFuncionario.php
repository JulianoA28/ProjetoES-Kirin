<?php

require_once('..\src\model\Funcionario');

	class TestFuncionario extends PHPUnit\Framework\TestCase {
		$nome = "Juliana";
		$email = "juliana@hotmail.com";
		$senha = "12345";
		$cpf = "123.456.789-02";
			
		public function testNome() {
			$obj = new Funcionario($nome, $email, $senha, $cpf);
			$this->assertEquals($nome, $obj->getNome(), "assert do nome");
		}
		
		public function testEmail() {
			$obj = new Funcionario($nome, $email, $senha, $cpf);
			$this->assertEquals($email, $obj->getEmail(), "assert do email");
		}
		
		public function testSenha() {	
			$obj = new Funcionario($nome, $email, $senha, $cpf);
			$this->assertEquals($senha, $obj->getSenha(), "assert da senha");
			
		}
		
		public function testCpf() {	
			$obj = new Funcionario($nome, $email, $senha, $cpf);
			$this->assertEquals($cpf, $obj->getCpf(), "assert do cpf");
			
		}
		
	}

?>
