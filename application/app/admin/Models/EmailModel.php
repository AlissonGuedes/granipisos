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
			'nome',
			'assunto',
			'datahora',
			null
		];

		//--------------------------------------------------------------------

		public function getAll($find = null) {

			$this -> select('*');

			if ( !is_null($find) && is_numeric($find) ) {
				$this -> where('id', $find);
				return $this ;
			}

			if ( isset($find['where']) ) {
				foreach($find['where'] as $ind => $val) {
					$this -> where($ind, $val);
				}
			}

			if ( isset($_GET['search']['value']) && ! empty($_GET['search']['value'])) {

				$search = $_GET['search']['value'];

				$this -> groupStart();

				$this -> orLike('id', $search);
				$this -> orLike('nome', $search);
				$this -> orLike('assunto', $search);
				$this -> orLike('datahora', $search);

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
						$msg = count($id) . ' ' . (count($id) > 1 ? 'e-mails desbloqueados' : 'e-mail desbloqueado') . '.';
					else
						$msg = count($id) . ' ' . (count($id) > 1 ? 'e-mails bloqueados' : 'e-mail bloqueado') . '.';
				break;
			}

			return $msg;

		}

		public function remove_email() {

			$id = $_POST['id'];

			if ( $this -> remove($id) ) {

				$replies = [];

				$emails = $this -> select('id') -> whereIn('id_reply', $id) 
						-> where('id_reply <>', '0') -> result();

				if ( !empty($emails) ) {

					foreach ($emails as $e ) {
						$replies[] = $e -> id;
					}
					
					if ( $this -> remove($replies) ) {
						return true;
					}

				}

				return true;

			}

			return FALSE;

		}

		public function sendMail($template)
		{

			$this -> email = \Config\Services :: email();

			$this -> email -> setMailType('html');
			$this -> email -> setFrom('contato@raboni.com.br', 'Contato do Site Raboni');
			$this -> email -> setTo($_POST['email']);
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
