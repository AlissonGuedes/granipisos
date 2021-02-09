<?php

namespace App\Entities
{

	class ProdutoCategoria extends AppEntity {

		/*
		 * Colunas
		 */
		protected $id = null;
		protected $categoria;
		protected $slug;
		protected $imagem;
		protected $status = '1';

		protected $datamap = [
		];

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

		public function setCategoria(string $str = null)
		{
			$this -> categoria = $str;
			return $this;
		}

		public function getCategoria()
		{
			return $this -> categoria;
		}

		public function setSlug()
		{
			$this -> slug = limpa_string($this -> categoria);
			return;
		}

		public function getSlug()
		{
			return $this -> slug;
		}

		/**
		 * Set Imagem do categoria
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

						$path =  $_SERVER['DOCUMENT_ROOT'] . $this -> config -> getBasePath() . 'img/categorias/';

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
		 * Get Imagem do categoria
		 *
		 * @return String
		 */
		public function getImagem(bool $realpath = false)
		{

			if ( $realpath )
				return $this -> imagem;

			return $this -> config -> getBasePath() . 'img/categorias/' . $this -> imagem;

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
