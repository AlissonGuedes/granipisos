<?php

namespace App\Entities
{

	class Email extends AppEntity {

		/*
		 * Colunas
		 */
		protected $id = null;
		protected $id_reply;
		protected $nome;
		protected $email;
		protected $telefone;
		protected $assunto;
		protected $mensagem;
		protected $datahora;
		protected $status = '0';

		protected $datamap = [];

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

		public function setIdReply($id = null) {
			$this -> id_reply = $id;
			return $this;
		}

		public function getIdReply(){
			return $this -> id_reply;
		}

		public function setNome($str = null)
		{
			$this -> nome = $str;
			return $this;
		}
		
		public function getNome()
		{
			return $this -> nome;
		}

		public function setEmail($str = null)
		{
			$this -> email = $str;
			return $this;
		}
		
		public function getEmail()
		{
			return $this -> email;
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

		public function setAssunto(string $str = null)
		{
			$this -> assunto = $str;
			return $this;
		}

		public function getAssunto()
		{
			return $this -> assunto;
		}

		public function setMensagem($str)
		{
			$this -> mensagem = $str;
			return;
		}

		public function getMensagem()
		{
			return $this -> mensagem;
		}

		public function setDataHora(string $str = null)
		{

			if ( ! is_null($str) )
				$datahora = $str;
			else
				return $this -> datahora = null;

			$this -> datahora = new \DateTime($datahora);

			return $this;

		}

		public function getDataHora(string $format = 'Y-m-d H:i:s')
		{
			if ( ! empty($this -> datahora) )
			{
				return $this -> datahora -> format($format);
			}
		}

		/**
		 * Set Imagem do email
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

						$path =  $_SERVER['DOCUMENT_ROOT'] . $this -> config -> getBasePath() . 'img/email/';

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
		 * Get Imagem do email
		 *
		 * @return String
		 */
		public function getImagem(bool $realpath = false)
		{

			if ( $realpath )
				return $this -> imagem;

			return $this -> config -> getBasePath() . 'img/email/' . $this -> imagem;

		}

		public function setStatus($str = null)
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
