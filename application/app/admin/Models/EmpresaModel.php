<?php

namespace App\Models {

	use \CodeIgniter\Model;

	class EmpresaModel extends AppModel {

		/**
		 * Nome da tabela do banco de dados a ser utilizada
		 * 
		 * @var string $table
		 */
		protected $table = 'tb_empresa';

		/**
		 * A chave primária da tabela
		 * 
		 * @var string $primaryKey
		 */
		protected $primaryKey = 'id';

		/**
		 * Classe espelho do banco de dados
		 * 
		 * @var string $returnType
		 */
		protected $returnType = '\App\Entities\Empresa';

		/**
		 * Validação para formulários
		 * 
		 * @var array $validationClass
		 */
		protected $validationClass = '\App\Validations\EmpresaValidation';
		
		/**
		 * Especificar quais colunas da tabela serão ordenadas
		 * 
		 * @var array $order
		 */
		protected $order = [];

		//--------------------------------------------------------------------

		public function getAll($find = null) {

			$this -> select('id, quem_somos, quem_somos_imagem, distribuidor_imagem, contato_imagem, telefone, celular, email, facebook, instagram, gplus, linkedin, github, gmaps');

			if ( !is_null($find) && is_numeric($find) ) {
				$this -> where('id', $find);
				return $this -> get() -> getRow();
			}

			if ( isset($_GET['search']['value']) && ! empty($_GET['search']['value'])) {

				$search = $_GET['search']['value'];

				$this -> groupStart();

				$this -> orLike('id', $search);
				$this -> orLike('nome', $search);
				$this -> orLike('email', $search);
				$this -> orLike('login', $search);
				$this -> orLike('tb_acl_grupo.grupo', $search);

				$this -> groupEnd();
				
			}

			if ( isset($_GET['start']) ) {
				$this -> limit($_GET['length']);
			}

			if ( isset($_GET['length']) ) {
				$this -> offset($_GET['start']);
			}

// echo $this -> getCompiledSelect();
// exit;

			return $this;

		}

	}

}