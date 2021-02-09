<?php

namespace App\Controllers {

	use \App\Models\ServicoModel;
	use \App\Models\ContatoModel;
	use \App\Models\EmailModel;

	class Servicos extends AppController
	{

		public function __construct() {

			$this -> servico_model = new ServicoModel();
			$this -> email_model = new EmailModel();
			$this -> contato_model = new ContatoModel();

		}

		//--------------------------------------------------------------------

		public function index() {

			$dados['servicos'] = $this -> servico_model -> getAll() -> result();
			$dados['categorias'] = $this -> servico_model -> getCategorias();

			return $this -> view('servicos/index', $dados);

		}

		public function categorias($categoria, $subcategoria) {

			$dados['row'] = $this -> servico_model -> getAll($categoria) -> get() -> getRow();
			return $this -> view('servicos/details', $dados);

		}

		//--------------------------------------------------------------------

		public function insert() {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $this -> email_model -> create_email() ) {

				$dados['cod_servico'] = $_POST['servico'];
				$dados['servico'] = $this -> servico_model -> getAll($_POST['servico']) -> get() -> getRow() -> nome;
				$dados[] = $_POST;

				$template = $this -> template('servicos/template_email.html', $dados);

				if ( $this -> contato_model -> sendMail($template) )
				{
				}

				$msg = 'Sua mensagem foi enviada com sucesso!';
				$status = 'success';
				$type = 'back';

			} else {
				$status = 'error';
				$fields = $this -> email_model -> errors();
			}

			echo json_encode(['status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type]);

		}

		//--------------------------------------------------------------------

	}

}