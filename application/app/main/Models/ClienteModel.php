<?php

namespace App\Models {

	use \CodeIgniter\Model;

	class ClienteModel extends AppModel {

		/**
		 * Nome da tabela do banco de dados a ser utilizada
		 *
		 * @var string $table
		 */
		protected $table = 'tb_cliente';

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
		protected $returnType = '\App\Entities\Cliente';

		/**
		 * Validação para formulários
		 *
		 * @var array $validationClass
		 */
		protected $validationClass = '\App\Validations\ClienteValidation';

		/**
		 * Especificar quais colunas da tabela serão ordenadas
		 *
		 * @var array $order
		 */
		protected $order = [
			null,
			'id',
			'nome',
			null,
			null,
			null
		];

		//--------------------------------------------------------------------

		public function getAll($find = null) {

			$this -> select('tb_cliente.id, tb_cliente.nome, tb_cliente.site, tb_cliente.imagem');

			$this -> distinct(true);

			$this -> join('tb_cliente_telefone', 'tb_cliente_telefone.id_cliente = tb_cliente.id', 'left');
			$this -> join('tb_cliente_email', 'tb_cliente_email.id_cliente = tb_cliente.id', 'left');

			if ( !is_null($find) ) {
				$this -> where('tb_cliente.id', $find);
				return $this;
			}

			$this -> where('tb_cliente.status', '1');

			if ( isset($_GET['search']['value']) && ! empty($_GET['search']['value'])) {

				$search = trim($_GET['search']['value']);

				$this -> groupStart();

				$this -> orLike('tb_cliente.id', $search);
				$this -> orLike('tb_cliente.nome', $search);
				$this -> orLike('tb_cliente_telefone.telefone', $search);
				$this -> orLike('tb_cliente_email.email', $search);

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

		public function getTelefones($cliente) {
			$this -> select('telefone');
			$this -> from('tb_cliente_telefone', true);
			$this -> where('id_cliente', $cliente);
			return $this -> get() -> getResult();
		}

		public function getEmails($cliente) {
			$this -> select('email');
			$this -> from('tb_cliente_email', true);
			$this -> where('id_cliente', $cliente);
			return $this -> get() -> getResult();
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
						$msg = count($id) . ' ' . (count($id) > 1 ? 'clientees desbloqueados' : 'cliente desbloqueado') . '.';
					else
						$msg = count($id) . ' ' . (count($id) > 1 ? 'clientees bloqueados' : 'cliente bloqueado') . '.';
				break;
			}

			return $msg;

		}

		public function getCategorias() {
			$this -> select('*') -> from('tb_cliente', true) -> where('status', '1');
			return $this;
		}

		public function sendMail($template)
		{

			$this -> email = \Config\Services :: email();

			$this -> email -> setMailType('html');
			$this -> email -> setFrom('alissonguedes87@gmail.com', 'Contato do Site Raboni');
			$this -> email -> setTo('alissonguedes87@gmail.com');
			$this -> email -> setSubject('Você foi cadastrado no site ' . configuracoes('title'));

			$this -> email -> setMessage($template);

			if ( ! $this -> email -> send() )
			{
				$error = 'Não foi possível enviar sua mensagem. Tente novamente mais tarde.';
				return $error;
			}

			return TRUE;

		}

	}

}
