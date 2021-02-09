<?php

namespace App\Entities
{

	class Lead extends AppEntity {

		/*
		 * Colunas
		 */
		protected $id = null;
		protected $id_produto;
		protected $id_cliente;
		protected $datahora;

		protected $datamap = array();

		public function setId($id = null)
		{
			$this -> id = $id;
			return $this;
		}

		public function getId()
		{
			return $this -> id;
		}

		public function setIdProduto($str)
		{
			$this -> id_produto = $str;
			return $this;
		}
		
		public function getIdProduto()
		{
			return $this -> id_produto;
		}

		public function setIdCliente($str) {
			$this -> id_cliente = $this -> email;
			return $this;
		}

		public function getIdCliente() {
			return $this -> id_cliente;
		}

	}

}
