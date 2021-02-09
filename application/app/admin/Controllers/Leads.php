<?php

namespace App\Controllers {
	
	use \App\Models\LeadModel;

	class Leads extends AppController
	{

		//--------------------------------------------------------------------

		public function __construct() {

			$this -> intencao_model = new LeadModel();

		}

		//--------------------------------------------------------------------

		public function index() {

			
			if ( isAjax() )
			{
				
				$dados['leads'] = $this -> intencao_model -> getAll();
				$dados['numRows']  = $this -> intencao_model -> numRows();
				return $this -> json('leads/datatable', $dados);

			}

			return $this -> view('leads/index');

		}
		
		//--------------------------------------------------------------------

		public function show($id) {

			$dados['method'] = is_null($id) ? 'post' : 'put';
			$dados['row'] = $this -> intencao_model -> getAll($id) -> get() -> getRow();
			return $this -> view('leads/details', $dados);

		}

		//--------------------------------------------------------------------

		public function insert() {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $this -> intencao_model -> create() ) {
				$msg = 'Intencao adicionado com sucesso!';
				$status = 'success';
				$type = 'back';
			} else {
				$status = 'error';
				$fields = $this -> intencao_model -> errors();
			}

			echo json_encode(['status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type]);

		}

		public function update() {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $this -> intencao_model -> edit() ) {
				$msg = 'Usuário atualizado com sucesso!';
				$status = 'success';
			} else {
				$status = 'error';
				$fields = $this -> intencao_model -> errors();
			}

			echo json_encode([ 'status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type ]);

		}

		//--------------------------------------------------------------------

		/**
		 * @param $resource => Nome do recurso a ser alterado.
		 */
		public function replace($resource) {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $msg = $this -> intencao_model -> updateResource($resource) ) {
				$status = 'success';
			} else {
				$status = 'error';
				$fields = $this -> intencao_model -> errors();
			}

			echo json_encode([ 'status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type ]);

		}

		//--------------------------------------------------------------------

		public function delete($id) {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $count = $this -> intencao_model -> remove() ){
				$status = 'success';
				$msg = $count . ' ' . ($count > 1 ? 'leads removidos' : 'lead removido') . '.';
			} else{
				$status = 'error';
				$msg = 'Não foi possível remover todos os leads selecionados.';
			}
			
			echo json_encode([ 'status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type ]);

		}

		//--------------------------------------------------------------------
		
	}
	
}