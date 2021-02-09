<?php

namespace App\Entities
{

	class Distribuidor extends AppEntity {

		/*
		 * Colunas
		 */
		protected $id = null;
		protected $nome;
		protected $email;
		protected $rua;
		protected $cep;
		protected $bairro;
		protected $cidade;
		protected $uf;
		protected $complemento;
		protected $status = '1';

		protected $datamap = [ ];

		private $datacadastro;
		private $agendamento;

		public function __construct(){
            parent::__construct();
            $this -> config = new \App\Entities\Configuracao();
		}

		public function setId($id = null)
		{
			$this -> id = $id;
			return $this;
		}

		public function getId()
		{
			return $this -> id;
		}
		
		public function setNome(string $str)
		{
			$this -> nome = $str;
			return $this;
		}
		
		public function getNome()
		{
			return $this -> nome;
		}
		
		public function setEmail(string $str = null) {
			$this -> email = $str;
			return $this;
		}

		public function getEmail(){
			return $this -> email;
		}

		public function setRua(string $str = null)
		{
			$this -> rua = $str;
			return $this;
		}

		public function getRua()
		{
			return $this -> rua;
		}

		public function setCep(string $str = null)
		{
			$this -> cep = $str;
			return $this;
		}

		public function getCep()
		{
			return $this -> cep;
		}

		public function setBairro(string $str = null)
		{
			$this -> bairro = $str;
			return $this;
		}

		public function getBairro()
		{
			return $this -> bairro;
		}

		public function setCidade(string $str = null)
		{
			$this -> cidade = $str;
			return $this;
		}

		public function getCidade()
		{
			return $this -> cidade;
		}

		public function setUf(string $str = null)
		{
			$this -> uf = $str;
			return $this;
		}

		public function getUf()
		{
			return $this -> uf;
		}

		public function setComplemento(string $str = null)
		{
			$this -> complemento = $str;
			return $this;
		}

		public function getComplemento()
		{
			return $this -> complemento;
		}

		public function setTelefone(string $str = null)
		{
			$this -> telefone = $str;
			return $this;
		}

		public function getTelefone()
		{
			return $this -> telefone;
		}

		/**
		 * Set Imagem do produto
		 *
		 * @param
		 *        	String
		 * @return String
		 */
		public function setImagem($str = null)
		{

			if ( ! isset($_SESSION[USERDATA]) )
				return FALSE;

			if ( empty($str) )
				return false;

			if ( ! is_null($str) && is_string($str) )
			{
				$this -> imagem = $str;
				return $this;
			}
			else
			{

				if ( ! is_null($str) )
				{

					foreach ( $str as $ind => $val )
					{

						$path =  $_SERVER['DOCUMENT_ROOT'] . $this -> config -> getBasePath() . 'img/distribuidores/';

						$file = $this -> request -> getFile($ind);

						if ( ! $file -> isValid() )
							return false;

						if ( ! is_dir($path) && is_writable($path) )
							mkdir($path, 0755, TRUE);

						$newName = $file -> getRandomName();
						$file -> move($path, $newName);

						$this -> imagem = $file -> getName();
	

					}

					return $this;

				}

			}

		}

		public function setOriginalName($img) {
			print_r($img);
			$this -> original_name = $img;
			return $this;
		}

		public function getOriginalName() {
			return $this -> original_name;
		}

		/**
		 * Get Imagem do produto
		 *
		 * @return String
		 */
		public function getImagem(bool $realpath = false)
		{

			if ( $realpath )
				return $this -> imagem;

			return $this -> config -> getBasePath() . 'img/distribuidores/' . $this -> imagem;

		}

		public function setStatus(string $str)
		{
			$this -> status = $str;
			return $this;
		}

		public function getStatus()
		{
			return $this -> status;
		}

	}

}
