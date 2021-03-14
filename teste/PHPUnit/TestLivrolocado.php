<?php

require_once('..\..\src\model\Livrolocado.php');

	class TestLivrolocado extends PHPUnit\Framework\TestCase {
			
		public function test() {
			$idLocacao = 10005;
			$idLivro = 100006;
			$cpfCliente = "123.456.789-01";
			
			$obj = new Livrolocado($idLocacao, $idLivro, $cpfCliente);
			
			$this->assertEquals($idLocacao, $obj->getIdLocacao(), "assert do id da locacao");
			$this->assertEquals($idLivro, $obj->getIdLivro(), "assert do id do livro");
			$this->assertEquals($cpfCliente, $obj->getCpfCliente(), "assert do cpf do cliente");
		}
		
	}

?>
