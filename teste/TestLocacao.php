<?php

require_once('..\src\model\Locacao.php');

	class TestLocacao extends PHPUnit\Framework\TestCase {
		
		public function test() {
			$cpfCliente = "123.456.789-01";
			$dataLimite = "2021-02-10";

			$obj = new Locacao($cpfCliente, $dataLimite);
			
			$this->assertEquals($cpfCliente, $obj->getCpfCliente(), "assert do cpf do cliente");
			$this->assertEquals($dataLimite, $obj->getDataLimite(), "assert da data limite");
		}
		
	}

?>
