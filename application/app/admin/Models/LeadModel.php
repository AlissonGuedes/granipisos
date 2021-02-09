<?php

namespace App\Models {

	use \CodeIgniter\Model;

	class LeadModel extends AppModel {

		/**
		 * Nome da tabela do banco de dados a ser utilizada
		 * 
		 * @var string $table
		 */
		protected $table = 'tb_lead';

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
		protected $returnType = '\App\Entities\Lead';

		/**
		 * Validação para formulários
		 * 
		 * @var array $validationClass
		 */
		protected $validationClass = '\App\Validations\LeadValidation';
		
		/**
		 * Especificar quais colunas da tabela serão ordenadas
		 * 
		 * @var array $order
		 */
		protected $order = [
			null,
			'id',
			'id_cliente',
			'id_produto',
			'datahora',
			null
		];

		//--------------------------------------------------------------------

		public function getAll($find = null) {

			$this -> select('tb_lead.id, tb_lead.id_cliente, tb_lead.id_produto, tb_lead.datahora');

			if ( !is_null($find) ) {
				$this -> where('tb_lead.id', $find);
				return $this;
			}

			if ( isset($_GET['search']['value']) && ! empty($_GET['search']['value'])) {

				$search = trim($_GET['search']['value']);

				$this -> groupStart();

				$this -> orLike('tb_lead.id', $search);
				$this -> orLike('tb_lead.id_cliente', $search);
				$this -> orLike('tb_lead.id_produto', $search);

				// $data = preg_replace_all('/', '-', $search);
				// echo $data = date('Y-m-d', strtotime($data));
				// $data = '';

				// print_r($matches);
				
				$this -> orLike('tb_lead.datahora', $data);

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
				$orderBy[$this -> order[4]] = 'asc';
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
						$msg = count($id) . ' ' . (count($id) > 1 ? 'lead desbloqueados' : 'lead desbloqueado') . '.';
					else
						$msg = count($id) . ' ' . (count($id) > 1 ? 'leads bloqueados' : 'lead bloqueado') . '.';
				break;
			}

			return $msg;

		}

		public function getCategorias() {
			$this -> select('*') -> from('tb_lead', true) -> where('status', '1');
			return $this;
		}

		public function getCliente($id) {
			return $this -> from('tb_cliente', true) -> select('nome, id') -> where('id', $id) -> get() -> getRow(); 
		}

		public function getProduto($id) {
			return $this -> from('tb_produto', true) -> select('nome, id') -> where('id', $id) -> get() -> getRow(); 
		}

	}

}
