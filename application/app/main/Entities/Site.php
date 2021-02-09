<?php

namespace App\Entities {

	class Site extends AppEntity {

		private $datalogin;

		protected $id;
		protected $config;
		protected $value;
		protected $status = '1';

		protected $datamap = array ();

		public function __construct() {

			$this -> config = new \App\Entities\Configuracao();

		}

		public function setId($id) {
			$this -> id = $id;
		}

		public function getId() {
			return $this -> id;
		}

		public function setConfig($config) {
			$this -> config = $config;
		}

		public function getConfig() {
			return $this -> config;
		}

		public function setValue($value) {
			$this -> value = $value;
		}

		public function getValue() {
			return $this -> value;
		}

		public function setStatus(string $str) {
			$this -> status = $str;
			return $this;
		}

		public function getStatus() {
			return $this -> status;
		}
	}

}
