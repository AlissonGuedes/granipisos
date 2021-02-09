<?php

namespace App\Models {

	use \CodeIgniter\Model;

	class EmailModel extends AppModel {

		/**
		 * Nome da tabela do banco de dados a ser utilizada
		 *
		 * @var string $table
		 */
		protected $table = 'tb_email';

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
		protected $returnType = '\App\Entities\Email';

		/**
		 * Validação para formulários
		 *
		 * @var array $validationClass
		 */
		protected $validationClass = '\App\Validations\EmailValidation';

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

			$this -> select('tb_email.id, tb_email.nome, tb_email.telefone, assunto, mensagem, datahora, status');

			if ( !is_null($find) ) {
				$this -> where('tb_email.id', $find);
				return $this;
			}

			if ( isset($_GET['search']['value']) && ! empty($_GET['search']['value'])) {

				$search = trim($_GET['search']['value']);

				$this -> groupStart();

				// $this -> orLike('tb_email.id', $search);
				// $this -> orLike('tb_email.id_cliente', $search);
				// $this -> orLike('tb_email.id_produto', $search);

				// $data = preg_replace_all('/', '-', $search);
				// echo $data = date('Y-m-d', strtotime($data));
				// // $data = '';

				// // print_r($matches);

				// $this -> orLike('tb_email.datahora', $data);

				// $this -> groupEnd();

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
						$msg = count($id) . ' ' . (count($id) > 1 ? 'email desbloqueados' : 'email desbloqueado') . '.';
					else
						$msg = count($id) . ' ' . (count($id) > 1 ? 'emails bloqueados' : 'email bloqueado') . '.';
				break;
			}

			return $msg;

		}

		public function getCategorias() {
			$this -> select('*') -> from('tb_email', true) -> where('status', '1');
			return $this;
		}

		public function create_email() {

			if ( $this -> validate($_POST) === false ){
				return false;
			}

			$cliente = new \App\Entities\Cliente();

			$data = $cliente -> fill($_POST);

			// $this -> transBegin();

			// insere o cliente na tabela `tb_cliente`.
			// if ( $c = $this -> getCliente($cliente) ) {
			// 	$id_cliente = $c -> id_cliente;
			// } else {
			// 	$this -> from('tb_cliente', true);
			// 	$id_cliente = $this -> insert(['nome' => $cliente -> getNome()]);
			// }

			// insere o telefone do cliente na tabela `tb_cliente_telefone`.
			// $this -> insert_telefone($id_cliente, $cliente);

			// // insere o e-mail do cliente na tabela `tb_cliente_email`.
			// $this -> insert_email($id_cliente, $cliente);

			// Inserir o email
			// $this -> insert_email($id_cliente, $_POST['produto']);

			return $this -> set($data) -> insert();

			// if ( $this -> transStatus() === TRUE ) {
			// 	$this -> transCommit();
			// 	return true;
			// } else {
			// 	$this -> transRollback();
			// 	return false;
			// }

		}

		public function getCliente($cliente) {

			$isset = $this -> select('tb_cliente_telefone.id_cliente, tb_cliente_telefone.telefone, tb_cliente_email.id_cliente, tb_cliente_email.email')
				  -> from('tb_cliente_telefone, tb_cliente_email', true)
				  -> groupStart()
				  	-> orWhere('tb_cliente_telefone.telefone', $cliente -> getTelefone())
				  	-> orWhere('tb_cliente_email.email', $cliente -> getEmail())
				  -> groupEnd()
				  -> get() -> getRow();

			return $isset;

		}

		public function insert_telefone($id_cliente, $cliente) {

			$query = $this -> prepare(function($db) {

				return $db -> table('tb_cliente_telefone') -> insert([
					'id_cliente' => '?',
					'telefone' => '?'
				]);

			});

			$isset = $this -> select('tb_cliente_telefone.id_cliente, tb_cliente_telefone.telefone')
				  -> from('tb_cliente_telefone', true)
				  -> where('tb_cliente_telefone.telefone', $cliente -> getTelefone())
				  -> get() -> getRow();

			if ( ! $isset )
				return $query -> execute($id_cliente, $cliente -> getTelefone());

		}

		// public function insert_email($id_cliente, $cliente) {

		// 	$query = $this -> prepare(function($db) {

		// 		return $db -> table('tb_cliente_email') -> insert([
		// 			'id_cliente' => '?',
		// 			'email' => '?'
		// 		]);

		// 	});

		// 	$isset = $this -> select('tb_cliente_email.id_cliente, tb_cliente_email.email')
		// 				   -> from('tb_cliente_email', true)
		// 				   -> where('tb_cliente_email.email', $cliente -> getEmail())
		// 				   -> get() -> getRow();

		// 	if ( ! $isset )
		// 		return $query -> execute($id_cliente, $cliente -> getEmail());

		// }

		// public function insert_email($id_cliente, $id_produto) {

		// 	$query = $this -> prepare(function($db) {

		// 		return $db -> table('tb_email') -> insert([
		// 			'id_cliente' => '?',
		// 			'id_produto' => '?'
		// 		]);

		// 	});

		// 	$isset = $this -> select('id_cliente, id_produto')
		// 				   -> from('tb_email', true)
		// 				   -> where('id_cliente', $id_cliente)
		// 				   -> where('id_produto', $id_produto)
		// 				   -> get()
		// 				   -> getRow();

		// 	if ( ! $isset )
		// 		return $query -> execute($id_cliente, $id_produto);

		// }

	}

}
