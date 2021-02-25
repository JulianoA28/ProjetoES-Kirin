<?php

require_once('..\src\model\Locacao.php');

	class TestCliente extends PHPUnit\Framework\TestCase {
		$cpfCliente = "123.456.789-01";
		$dataLimite = "2021-02-10";
		
		public function testCpfCliente() {
			$obj = new Locacao($cpfCliente, $dataLimite);
			$this->assertEquals($cpfCliente, $obj->getCpfCliente(), "assert do cpf do cliente");
		}
		
		public function testDataLimite() {		
			$obj = new Locacao($cpfCliente, $dataLimite);
			$this->assertEquals($dataLimite, $obj->getDataLimite(), "assert da data limite");
		}
		
	}

?>
