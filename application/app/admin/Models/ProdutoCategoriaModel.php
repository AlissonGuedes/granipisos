<?php

namespace App\Models {

	use \CodeIgniter\Model;

	class ProdutoCategoriaModel extends AppModel {

		/**
		 * Nome da tabela do banco de dados a ser utilizada
		 * 
		 * @var string $table
		 */
		protected $table = 'tb_produto_categoria';

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
		protected $returnType = '\App\Entities\ProdutoCategoria';

		/**
		 * Validação para formulários
		 * 
		 * @var array $validationClass
		 */
		protected $validationClass = '\App\Validations\ProdutoCategoriaValidation';
		
		/**
		 * Especificar quais colunas da tabela serão ordenadas
		 * 
		 * @var array $order
		 */
		protected $order = [
			null,
			'id',
			'categoria',
			'status',
			null
		];

		//--------------------------------------------------------------------

		public function getAll($find = null) {

			$this -> select('*');

			if ( !is_null($find) ) {
				$this -> where('id', $find);
				return $this ;
			}

			if ( isset($_GET['search']['value']) && ! empty($_GET['search']['value'])) {

				$search = $_GET['search']['value'];

				$this -> groupStart();

				$this -> orLike('id', $search);
				$this -> orLike('categoria', $search);

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
                $orderBy[$this -> order[$_GET['order'][0]['column']]] = $_GET['order'][0]['dir'];
			} else {
				$orderBy[$this -> order[1]] = 'desc';
				$orderBy[$this -> order[2]] = 'asc';
				$orderBy[$this -> order[3]] = 'desc';
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
						$msg = count($id) . ' ' . (count($id) > 1 ? 'categoria desbloqueadas' : 'categoria desbloqueada') . '.';
					else
						$msg = count($id) . ' ' . (count($id) > 1 ? 'categorias bloqueadas' : 'categoria bloqueada') . '.';
				break;
			}

			return $msg;

		}

	}

}
