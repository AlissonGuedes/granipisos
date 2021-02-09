<?php

namespace App\Models {

	use \CodeIgniter\Model;

	class BannerModel extends AppModel {

		/**
		 * Nome da tabela do banco de dados a ser utilizada
		 * 
		 * @var string $table
		 */
		protected $table = 'tb_banner';

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
		protected $returnType = '\App\Entities\Banner';

		/**
		 * Validação para formulários
		 * 
		 * @var array $validationClass
		 */
		protected $validationClass = '\App\Validations\BannerValidation';
		
		/**
		 * Especificar quais colunas da tabela serão ordenadas
		 * 
		 * @var array $order
		 */
		protected $order = [
			null,
			'id',
			'titulo',
			'descricao',
			'dataadd',
			'status',
			null
		];

		//--------------------------------------------------------------------

		public function getAll($find = null) {

			$this -> select('*');

			// if ( !is_null($find) ) {
			// 	$this -> where('id', $find);
			// 	return $this;
			// }

			$this -> where('status', '1');

			// if ( isset($_GET['search']['value']) && ! empty($_GET['search']['value'])) {

			// 	$search = $_GET['search']['value'];

			// 	$this -> groupStart();

			// 	$this -> orLike('id', $search);
			// 	$this -> orLike('titulo', $search);
			// 	$this -> orLike('descricao', $search);

			// 	$this -> groupEnd();
				
			// }

			// if ( isset($_GET['start']) ) {
			// 	$this -> limit($_GET['length']);
			// }

			// if ( isset($_GET['length']) ) {
			// 	$this -> offset($_GET['start']);
			// }

			// Order By
            if (isset($_GET['order']) && $_GET['order'][0]['column'] != 0 ) {
                $orderBy[$this -> order[$_GET['order'][0]['column']]] = $_GET['order'][0]['dir'];
			} else {
				$orderBy[$this -> order[5]] = 'desc';
				$orderBy[$this -> order[2]] = 'asc';
				$orderBy[$this -> order[4]] = 'desc';
			}

			foreach($orderBy as $key => $val) {
				$this -> orderBy($key, $val);
			}

			return $this;

		}

		public function updateResource($resource) {
			
			$msg = null;
			$column = $resource;
			$id = $_POST['id'];
			$value = $_POST['value'];

			$this -> builder() -> set($column, $value) -> whereIn('id', $id) -> update();

			switch($resource) {
				case 'status':
					if ( $value ) 
						$msg = count($id) . ' ' . (count($id) > 1 ? 'banner desbloqueados' : 'banner desbloqueado') . '.';
					else
						$msg = count($id) . ' ' . (count($id) > 1 ? 'banners bloqueados' : 'banner bloqueado') . '.';
				break;
			}

			return $msg;

		}

	}

}
