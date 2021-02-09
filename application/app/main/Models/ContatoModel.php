<?php

namespace App\Models {

	use \CodeIgniter\Model;

	class ContatoModel extends AppModel {

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
			'nome',
			null,
			null,
			null
		];

		//--------------------------------------------------------------------

		public function getAll($find = null) {

			$this -> select('tb_email.id, tb_email.nome, tb_email.rua, tb_email.bairro, tb_email.cidade, tb_email.uf');

			$this -> distinct(true);

			$this -> join('tb_email_telefone', 'tb_email_telefone.id_contato = tb_email.id', 'left');
			$this -> join('tb_email_email', 'tb_email_email.id_contato = tb_email.id', 'left');

			if ( !is_null($find) ) {
				$this -> where('tb_email.id', $find);
				return $this;
			}

			if ( isset($_GET['search']['value']) && ! empty($_GET['search']['value'])) {

				$search = trim($_GET['search']['value']);

				$this -> groupStart();

				$this -> orLike('tb_email.id', $search);
				$this -> orLike('tb_email.nome', $search);
				$this -> orLike('tb_email_telefone.telefone', $search);
				$this -> orLike('tb_email_email.email', $search);

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

		public function getTelefones($contato) {
			$this -> select('telefone');
			$this -> from('tb_email_telefone', true);
			$this -> where('id_contato', $contato);
			return $this -> get() -> getResult();
		}

		public function getEmails($contato) {
			$this -> select('email');
			$this -> from('tb_email_email', true);
			$this -> where('id_contato', $contato);
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
						$msg = count($id) . ' ' . (count($id) > 1 ? 'contatoes desbloqueados' : 'contato desbloqueado') . '.';
					else
						$msg = count($id) . ' ' . (count($id) > 1 ? 'contatoes bloqueados' : 'contato bloqueado') . '.';
				break;
			}

			return $msg;

		}

		public function getCategorias() {
			$this -> select('*') -> from('tb_email', true) -> where('status', '1');
			return $this;
		}

		public function sendMail($template)
		{

			$this -> email = \Config\Services :: email();

			$this -> email -> setMailType('html');
			$this -> email -> setFrom($_POST['email'], $_POST['nome']);

			$this -> email -> setTo(configuracoes('email', 'tb_empresa'), 'Contato do Site' . configuracoes('title'));
			// $this -> email -> setTo('alissonguedes87@gmail.com');

			$this -> email -> setSubject('Você recebeu uma nova mensagem no site ' . configuracoes('title'));

			$this -> email -> setMessage($template);

			if ( ! $this -> email -> send() )
			{
				$error = 'Não foi possível enviar sua mensagem. Tente novamente mais tarde.';
				return $error;
			} else {

			}

			return TRUE;

		}

	}

}
