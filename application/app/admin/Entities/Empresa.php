<?php

namespace App\Entities {

	class Empresa extends AppEntity {

		private $basepath;

		/*
		 * Colunas
		 */
		protected $id = null;
		protected $title = null;
		protected $descripition = null;
		protected $quem_somos = null;
		protected $quem_somos_imagem = null;
		protected $distribuidor_imagem = null;
		protected $contato_imagem = null;
		protected $keywords = null;
		protected $generator = 'Aptana Studio 3';
		protected $author = 'Alisson Guedes';
		protected $creator_address = 'alissonguedes87@gmail.com';
		protected $custodian = 'Guedes, Alisson';
		protected $publisher = 'Alisson Guedes';
		protected $revisit_after = '15 days';
		protected $rating = 'general';
		protected $robots = null;
		protected $theme_color = null;
		protected $path = null;
		protected $logomarca = null;
		protected $language = 'pt-br';
		protected $msg_manutencao = 'Site em manutenção';
		protected $msg_bloqueio_temporario = 'Site temporariamente bloqueado.';
		protected $version = 0.00;
		protected $logomarca_nf = null;
		protected $texto_apresentacao = null;
		protected $facebook = null;
		protected $instagram = null;
		protected $twitter = null;
		protected $youtube = null;
		protected $linkedin = null;
		protected $gplus = null;
		protected $gmaps = null;
		protected $website = null;
		protected $telefone = null;
		protected $celular = null;
		protected $email = null;
		protected $manutencao = '0';
		protected $publicado = '0';

		protected $datamap = array();

		private $datetime;

		public function setId($id = null)
		{
			$this -> id = $id;
			return $this;
		}

		public function getId()
		{
			return $this -> id;
		}

		public function setTitle(string $str = null)
		{
			$this -> title = $str;
			return $this;
		}

		public function getTitle()
		{
			return $this -> title;
		}

		public function setDescription(string $str = null)
		{
			$this -> descripition = $str;
			return $this;
		}

		public function getDescription()
		{
			return $this -> descripition;
		}

		public function setQuemSomos(string $str = null)
		{
			$this -> quem_somos = $str;
			return $this;
		}

		public function getQuemSomos()
		{
			return $this -> quem_somos;
		}
		public function setKeywords(array $str = null)
		{
			$this -> keywords = $str;
			return $this;
		}

		public function getKeywords()
		{
			if ( ! empty($this -> keywords) )
				return implode(',', $this -> keywords);
		}

		public function setGenerator(string $str = null)
		{
			$this -> generator = $str;
			return $this;
		}

		public function getGenerator()
		{
			return $this -> generator;
		}

		public function setAuthor(string $str = null)
		{
			$this -> author = $str;
			return $this;
		}

		public function getAuthor()
		{
			return $this -> author;
		}

		public function setCreatorAddress(string $str = null)
		{
			$this -> creator_address = $str;
			return $this;
		}

		public function getCreatorAddress()
		{
			return $this -> creator_address;
		}

		public function setCustodian(string $str = null)
		{
			$this -> custodian = $str;
			return $this;
		}

		public function getCustodian()
		{
			return $this -> custodian;
		}

		public function setPublisher(string $str = null)
		{
			$this -> publisher = $str;
			return $this;
		}

		public function getPublisher()
		{
			return $this -> publisher;
		}

		public function setRevistAfter(string $str = null)
		{
			$this -> revisit_after = $str;
			return $this;
		}

		public function getRevistAfter()
		{
			return $this -> revisit_after;
		}

		public function setRating(string $str = null)
		{
			$this -> rating = $str;
			return $this;
		}

		public function getRating()
		{
			return $this -> rating;
		}

		public function setRobots(string $str = null)
		{
			$this -> robots = $str;
			return $this;
		}

		public function getRobots()
		{
			return $this -> robots;
		}

		public function setThemeColor(string $str = null)
		{
			$this -> theme_color = $str;
			return $this;
		}

		public function getThemeColor()
		{
			return $this -> theme_color;
		}

		public function getBasePath()
		{
			return $this -> basePath =  base_path(TRUE);
		}

		public function setPath(string $str = null)
		{

			$this -> path = dirname(base_path()) . $str;

			return $this;

		}

		public function getPath()
		{
			return $this -> path;
		}

		/**
		 * Set Logomarca
		 *
		 * @param
		 *        	String
		 * @return String
		 */
		public function setLogomarca($str = null)
		{

			if ( ! isset($_SESSION[USERDATA]) )
				return FALSE;

			if ( empty($str) )
				return false;

			if ( ! is_null($str) && is_string($str) )
			{
				$this -> logomarca = $str;
				return $this;
			}
			else
			{

				if ( ! is_null($str) )
				{

					foreach ( $str as $ind => $val )
					{

						$path = $_SERVER['DOCUMENT_ROOT'] . $this -> getBasePath() . 'img/logo/';

						$file = $this -> request -> getFile($ind);

						if ( ! $file -> isValid() )
							return false;

						if ( ! is_dir($path) )
							mkdir($path, 0777, TRUE);

						$newName = $file -> getRandomName();
						$file -> move($path, $newName);

						$this -> logomarca = $file -> getName();

					}

					return $this;

				}

			}

		}

		/**
		 * Get Logomarca
		 *
		 * @return String
		 */
		public function getLogomarca(bool $realpath = false)
		{

			if ( $realpath )
				return base_path() . $this -> logomarca;

			return $this -> getBasePath() . 'img/logo/' . $this -> logomarca;

		}

		/**
		 * Set quem_somos_imagem
		 *
		 * @param
		 *        	String
		 * @return String
		 */
		public function setQuemSomosImagem($str = null)
		{

			if ( ! isset($_SESSION[USERDATA]) )
				return FALSE;

			if ( empty($str) )
				return false;

			if ( ! is_null($str) && is_string($str) )
			{
				$this -> quem_somos_imagem = $str;
				return $this;
			}
			else
			{

				foreach ( $str as $ind => $val )
				{

					$path = $_SERVER['DOCUMENT_ROOT'] . $this -> getBasePath() . 'img/quem_somos/';

					$file = $this -> request -> getFile($ind);

					if ( ! $file -> isValid() )
						return false;

					if ( ! is_dir($path) )
						mkdir($path, 0777, TRUE);

					$newName = $file -> getRandomName();
					$file -> move($path, $newName);

					$this -> quem_somos_imagem = $file -> getName();

					return $this;

				}

			}

		}

		/**
		 * Get Logomarca
		 *
		 * @return String
		 */
		public function getQuemSomosImagem(bool $realpath = false)
		{

			if ( $realpath )
				return base_path() . $this -> quem_somos_imagem;

			return $this -> getBasePath() . 'img/quem_somos/' . $this -> quem_somos_imagem;

		}


		/**
		 * Set distribuidor_imagem
		 *
		 * @param
		 *        	String
		 * @return String
		 */
		public function setDistribuidorImagem($str = null)
		{

			if ( ! isset($_SESSION[USERDATA]) )
				return FALSE;

			if ( empty($str) )
				return false;

			if ( ! is_null($str) && is_string($str) )
			{
				$this -> distribuidor_imagem = $str;
				return $this;
			}
			else
			{

				foreach ( $str as $ind => $val )
				{

					$path = $_SERVER['DOCUMENT_ROOT'] . $this -> getBasePath() . 'img/quem_somos/';

					$file = $this -> request -> getFile($ind);

					if ( ! $file -> isValid() )
						return false;

					if ( ! is_dir($path) )
						mkdir($path, 0777, TRUE);

					$newName = $file -> getRandomName();
					$file -> move($path, $newName);

					$this -> distribuidor_imagem = $file -> getName();

					return $this;

				}

			}

		}

		/**
		 * Get DistribuidorImagem
		 *
		 * @return String
		 */
		public function getDistribuidorImagem(bool $realpath = false)
		{

			if ( $realpath )
				return base_path() . $this -> distribuidor_imagem;

			return $this -> getBasePath() . 'img/quem_somos/' . $this -> distribuidor_imagem;

		}



		/**
		 * Set quem_somos_imagem
		 *
		 * @param
		 *        	String
		 * @return String
		 */
		public function setContatoImagem($str = null)
		{

			if ( ! isset($_SESSION[USERDATA]) )
				return FALSE;

			if ( empty($str) )
				return false;

			if ( ! is_null($str) && is_string($str) )
			{
				$this -> contato_imagem = $str;
				return $this;
			}
			else
			{

				foreach ( $str as $ind => $val )
				{

					$path = $_SERVER['DOCUMENT_ROOT'] . $this -> getBasePath() . 'img/quem_somos/';

					$file = $this -> request -> getFile($ind);

					if ( ! $file -> isValid() )
						return false;

					if ( ! is_dir($path) )
						mkdir($path, 0777, TRUE);

					$newName = $file -> getRandomName();
					$file -> move($path, $newName);

					$this -> contato_imagem = $file -> getName();

					return $this;

				}

			}

		}

		/**
		 * Get Logomarca
		 *
		 * @return String
		 */
		public function getContatoImagem(bool $realpath = false)
		{

			if ( $realpath )
				return base_path() . $this -> contato_imagem;

			return $this -> getBasePath() . 'img/quem_somos/' . $this -> contato_imagem;

		}

		public function setLanguage(string $str = null)
		{
			$this -> language = $str;
			return $this;
		}

		public function getLanguage()
		{
			return $this -> language;
		}

		public function setMsgManutencao(string $str = null)
		{
			$this -> msg_manutencao = strtr($str, array(
				'{{email}}' => '<a href="mailto:' . $this -> getEmail() . '">' . $this -> getEmail() . '</a>',
				'{{telefone}}' => '<a href="phone:' . $this -> getEmail() . '">' . $this -> getTelefone() . '</a>',
				'{{celular}}' => '<a href="phone:' . $this -> getEmail() . '">' . $this -> getCelular() . '</a>'
			));
			return $this;
		}

		public function getMsgManutencao()
		{
			return $this -> msg_manutencao;
		}

		public function setMsgBloqueioTemporario(string $str = null)
		{
			$this -> msg_bloqueio_temporario = strtr($str, array(
				'{{email}}' => '<a href="mailto:' . $this -> getEmail() . '">' . $this -> getEmail() . '</a>',
				'{{telefone}}' => '<a href="phone:' . $this -> getEmail() . '">' . $this -> getTelefone() . '</a>',
				'{{celular}}' => '<a href="phone:' . $this -> getEmail() . '">' . $this -> getCelular() . '</a>'
			));
			return $this;
		}

		public function getMsgBloqueioTemporario()
		{
			return $this -> msg_bloqueio_temporario;
		}

		public function setVersion(float $num = null)
		{
			$this -> version = $num;
			return $this;
		}

		public function getVersion()
		{
			return $this -> version;
		}

		/**
		 * Set Logomarca
		 *
		 * @param
		 *        	String
		 * @return String
		 */
		public function setLogomarcaNf($str = null)
		{

			if ( ! isset($_SESSION[USERDATA]) )
				return FALSE;

			if ( empty($str) )
				return false;

			if ( ! is_null($str) && is_string($str) )
			{
				$this -> logomarca_nf = $str;
				return $this;
			}
			else
			{

				if ( ! is_null($str) )
				{

					foreach ( $str as $ind => $val )
					{

						$path = $_SERVER['DOCUMENT_ROOT'] . $this -> getBasePath() . 'img/logonf/';

						$file = $this -> request -> getFile($ind);

						if ( ! $file -> isValid() )
							return false;

						if ( ! is_dir($path) )
							mkdir($path, 0777, TRUE);

						$newName = $file -> getRandomName();
						$file -> move($path, $newName);

						$this -> logomarca_nf = $file -> getName();

					}

					return $this;

				}

			}

		}

		/**
		 * Get Logomarca
		 *
		 * @return String
		 */
		public function getLogomarcaNf(bool $realpath = false)
		{

			if ( $realpath )
				return base_path() . $this -> logomarca_nf;

			return $this -> getBasePath() . '/img/logonf/' . $this -> logomarca_nf;

		}

		public function setTextoApresentacao(string $str = null)
		{
			$this -> texto_apresentacao = $str;
			return $this;
		}

		public function getTextoApresentacao()
		{
			return $this -> texto_apresentacao;
		}

		public function setFacebook(string $str = null)
		{
			$this -> facebook = $str;
			return $this;
		}

		public function getFacebook()
		{
			return $this -> facebook;
		}

		public function setInstagram(string $str = null)
		{
			$this -> instagram = $str;
			return $this;
		}

		public function getInstagram()
		{
			return $this -> instagram;
		}

		public function setTwitter(string $str = null)
		{
			$this -> twitter = $str;
			return $this;
		}

		public function getTwitter()
		{
			return $this -> twitter;
		}

		public function setYoutube(string $str = null)
		{
			$this -> youtube = $str;
			return $this;
		}

		public function getYoutube()
		{
			return $this -> youtube;
		}

		public function setLinkedin(string $str = null)
		{
			$this -> linkedin = $str;
			return $this;
		}

		public function getLinkedin()
		{
			return $this -> linkedin;
		}

		public function setGplus(string $str = null)
		{
			$this -> gplus = $str;
			return $this;
		}

		public function getGplus()
		{
			return $this -> gplus;
		}

		public function setGmaps(string $str = null)
		{
			$this -> gmaps = htmlentities($str);
			return $this;
		}

		public function getGmaps()
		{
			return $this -> gmaps;
		}

		public function setWebsite(string $str = null)
		{
			$this -> website = $str;
			return $this;
		}

		public function getWebsite()
		{
			return $this -> website;
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

		public function setCelular(string $str = null)
		{
			$this -> celular = $str;
			return $this;
		}

		public function getCelular()
		{
			return $this -> celular;
		}

		public function setEmail(string $str = null)
		{
			$this -> email = $str;
			return $this;
		}

		public function getEmail()
		{
			return $this -> email;
		}

		public function setDataCadastro(string $str = null)
		{

			if ( ! is_null($str) )
				$this -> data_cadastro = $str;
			else
				return $this -> data_cadastro = null;

			$this -> datetime = new \DateTime($this -> data_cadastro);

			return $this;

		}

		public function getDataCadastro(string $format = 'Y-m-d H:i:s')
		{
			if ( ! empty($this -> data_cadastro) )
			{
				return $this -> datetime -> format($format);
			}
		}

		public function setManutencao(string $str)
		{
			$this -> manutencao = $str;
			return $this;
		}

		public function getManutencao()
		{
			return $this -> manutencao;
		}

		public function setPublicado(string $str)
		{
			$this -> publicado = $str;
			return $this;
		}

		public function getPublicado()
		{
			return $this -> publicado;
		}

	}

}