<?php

namespace App\Models {

	use \CodeIgniter\Model;

	class SiteModel extends AppModel {

		/**
		 * Nome da tabela do banco de dados a ser utilizada
		 * 
		 * @var string $table
		 */
		protected $table = 'tb_sys_config';

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
		protected $returnType = '\App\Entities\Configuracao';

		/**
		 * Validação para formulários
		 * 
		 * @var array $validationClass
		 */
		protected $validationClass = '\App\Validations\SiteValidation';
		
		/**
		 * Especificar quais colunas da tabela serão ordenadas
		 * 
		 * @var array $order
		 */
		protected $order = [
			null, 
			'nome',
			'(SELECT grupo FROM tb_acl_grupo WHERE tb_acl_grupo.id = id_grupo)',
			'email',
			'ultimo_login',
			'status'
		];

		//--------------------------------------------------------------------

		public function getAll($find = null) {

			$this -> select('id, title, description, quem_somos');

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

			// Order By
            if (isset($_GET['order']) && $_GET['order'][0]['column'] != 0 ) {
                $orderBy = $this -> order[$_GET['order'][0]['column']];
				$direction = $_GET['order'][0]['dir'];
			} else {
				$orderBy = $this -> order[1];
				$direction = 'asc';
			}

			$this -> orderBy($orderBy, $direction);

			echo $this -> getCompiledSelect();
			return $this;

		}

	}

}