<?php

namespace App\Controllers {

	use \App\Models\ClienteModel;
	use \App\Models\ContatoModel;

	class Clientes extends AppController
	{

		public function __construct(){

			$this -> contato_model = new ContatoModel();
			$this -> clientes_model = new ClienteModel();
		}

		//--------------------------------------------------------------------

		public function index() {

			$dados['rows'] = $this -> clientes_model -> getAll();

			return $this -> view('clientes/index', $dados);

		}

		//--------------------------------------------------------------------

		public function insert() {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $this -> clientes_model -> create() ) {

				$template = $this -> template('clientes/template_email.html', $_POST);

				if ( $msg = $this -> contato_model -> sendMail($template) )
				{
					$msg = 'Mensagem enviada com sucesso!';
					$status = 'success';
					$type = 'back';
				}

			} else {
				$status = 'error';
				$fields = $this -> clientes_model -> errors();
			}

			echo json_encode(['status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type]);

		}

		//--------------------------------------------------------------------

	}

}
