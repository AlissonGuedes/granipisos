<?php

namespace App\Entities
{

	class Banner extends AppEntity {

		/*
		 * Colunas
		 */
		protected $id = null;
		protected $id_autor;
		private $autor;
		protected $titulo;
		protected $alias;
		protected $descricao;
		protected $url;
		protected $imagem;
		protected $original_name;
		protected $dataadd = 'now';
		protected $status = '0';

		protected $datamap = ['autor' => 'id_autor'];

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

		public function setIdAutor($id = null) {
			$this -> id_autor = ! is_null($id) ? $id : $_SESSION[USERDATA]['id'];
			return $this;
		}

		public function getIdAutor(){
			return $this -> id_autor;
		}

		public function setAutor($id = null)
		{
			$this -> autor = $id;
			return $this;
		}

		public function getAutor()
		{
			return $this -> autor;
		}

		public function setTitulo(string $str = null)
		{
			$this -> titulo = $str;
			return $this;
		}

		public function getTitulo()
		{
			return $this -> titulo;
		}

		public function setAlias()
		{
			$this -> alias = limpa_string($this -> titulo);
			return;
		}

		public function getAlias()
		{
			return $this -> alias;
		}

		public function setDescricao(string $str = null)
		{
			$this -> descricao = $str;
			return $this;
		}

		public function getDescricao()
		{
			return $this -> descricao;
		}

		public function setUrl(string $str = null)
		{
			$this -> url = $str;
			return $this;
		}

		public function getUrl()
		{
			return $this -> url;
		}

		public function setDataAdd(string $str = null)
		{

			if ( ! is_null($str) )
				$this -> data_add = $str;
			else
				return $this -> data_add = null;

			$this -> datacadastro = new \DateTime($this -> data_add);

			return $this;

		}

		public function getDataAdd(string $format = 'Y-m-d H:i:s')
		{
			if ( ! empty($this -> data_add) )
			{
				return $this -> datacadastro -> format($format);
			}
		}

		/**
		 * Set Imagem do banner
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

				$path =  $_SERVER['DOCUMENT_ROOT'] . $this -> config -> getBasePath() . 'img/banners/';

				if ( ! is_dir($path) && is_writable($path) )
					mkdir($path, 0755, TRUE);

				foreach ( $str as $ind => $val )
				{

					$file = $this -> request -> getFile($ind);

					if ( ! $file -> isValid() )
						return false;

					$this -> original_name = $file -> getName();

					$newName = $file -> getRandomName();
					$file -> move($path, $newName);

					$this -> imagem = $file -> getName();


				}

				return $this;

			}

		}

		public function setOriginalName() {
			$this -> original_name = $this -> original_name;
			return $this;
		}

		public function getOriginalName() {
			return $this -> original_name;
		}

		/**
		 * Get Imagem do banner
		 *
		 * @return String
		 */
		public function getImagem(bool $realpath = false)
		{

			if ( $realpath )
				return $this -> imagem;

			return $this -> config -> getBasePath() . 'img/banners/' . $this -> imagem;

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
