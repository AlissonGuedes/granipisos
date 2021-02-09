<?php

namespace App\Controllers {
	
	use \App\Models\ContatoModel;

	class Contato extends AppController
	{

		public function __construct(){

			$this -> contato_model = new ContatoModel();
		}

		//--------------------------------------------------------------------

		public function index() {

			$dados[] = null;

			return $this -> view('contato/contato', $dados);

		}
		
		//--------------------------------------------------------------------

		public function insert() {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $this -> contato_model -> create() ) {

				$template = $this -> template('contato/template_email.html', $_POST);

				if ( $this -> contato_model -> sendMail($template) )
				{
					$msg = 'Mensagem enviada com sucesso!';
					$status = 'success';
					$type = 'back';
				}

			} else {
				$status = 'error';
				$fields = $this -> contato_model -> errors();
			}

			echo json_encode(['status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type]);

		}

		//--------------------------------------------------------------------
		
	}
	
}
