<?php

namespace App\Controllers {
	
	use \App\Models\EmailModel;

	class Email extends AppController
	{

		//--------------------------------------------------------------------

		public function __construct() {

			$this -> email_model = new EmailModel();

		}

		//--------------------------------------------------------------------

		public function index() {

			
			if ( isAjax() )
			{
				
				$dados['emails'] = $this -> email_model -> getAll(['where' => ['id_reply' => '0'] ]) -> result();
				$dados['numRows']  = $this -> email_model -> numRows();
				return $this -> json('email/datatable', $dados);

			}

			return $this -> view('email/index');

		}
		
		//--------------------------------------------------------------------

		public function formulario($id) {

			$dados['method'] = is_null($id) ? 'post' : 'put';
			$dados['row'] = $this -> email_model -> getAll($id) -> get() -> getRow();
			return $this -> view('email/formulario', $dados);

		}

		//--------------------------------------------------------------------

		public function show($id) {

			$dados['row'] = $this -> email_model -> getAll($id) -> get() -> getRow();

			if ( isset($dados['row']) ) {
				return $this -> view('email/details', $dados);
			}

			location(base_url() . 'mail');

		}

		//--------------------------------------------------------------------

		public function insert() {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;
			$url    = base_url() . 'mail';

			if ( $this -> email_model -> create() ) {

				$template = $this -> template('email/template_email.html', $_POST);

				if ( $this -> email_model -> sendMail($template) )
				{
					$msg = 'Mensagem enviada com sucesso!';
					$status = 'success';
					$type = 'back';
				}

			} else {
				$status = 'error';
				$fields = $this -> email_model -> errors();
			}

			echo json_encode(['status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type, 'url' => $url]);

		}

		public function update() {

			$type   = null;
			$url	= base_url() . 'mail';
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $this -> email_model -> edit() ) {
				$msg = 'E-mail atualizado com sucesso!';
				$status = 'success';
			} else {
				$status = 'error';
				$fields = $this -> email_model -> errors();
			}

			echo json_encode([ 'status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type, 'url' => $url ]);

		}

		//--------------------------------------------------------------------

		/**
		 * @param $resource => Nome do recurso a ser alterado.
		 */
		public function replace($resource) {

			$type   = null;
			$url	= base_url() . 'mail';
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $msg = $this -> email_model -> updateResource($resource) ) {
				$status = 'success';
			} else {
				$status = 'error';
				$fields = $this -> email_model -> errors();
			}

			echo json_encode([ 'status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type, 'url' => $url ]);

		}

		//--------------------------------------------------------------------

		public function delete($id) {

			$type   = null;
			$url	= base_url() . 'mail';
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $count = $this -> email_model -> remove_email() ) {
				$status = 'success';
				$msg = $count . ' ' . ($count > 1 ? 'e-mails removidos' : 'e-mail removido') . '.';
			} else{
				$status = 'error';
				$msg = 'Não foi possível remover todos os e-mails selecionados.';
			}
			
			echo json_encode([ 'status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type, 'url' => $url ]);

		}

		//--------------------------------------------------------------------

		//--------------------------------------------------------------------

		public function template_email() {
			
			if ( isAjax() )
			{
				
				$dados['emails'] = $this -> email_model -> getAll(['where' => ['id_reply' => '0'] ]) -> result();
				$dados['numRows']  = $this -> email_model -> numRows();
				return $this -> json('email/datatable', $dados);

			}

			return $this -> view('email/editar_template');

		}

	}
	
}