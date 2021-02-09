<?php

namespace App\Controllers {
	
	use \App\Models\BannerModel;

	class Banners extends AppController
	{

		//--------------------------------------------------------------------

		public function __construct() {

			$this -> banner_model = new BannerModel();

		}

		//--------------------------------------------------------------------

		public function index() {

			
			if ( isAjax() )
			{
				
				$dados['banners'] = $this -> banner_model -> getAll();
				$dados['numRows']  = $this -> banner_model -> numRows();
				return $this -> json('banners/datatable', $dados);
				
			}
			
			$dados['rows'] = $this -> banner_model -> getAll();
			// return $this -> view('banners/teste.datatable.phtml', $dados);
			return $this -> view('banners/index', $dados);

		}
		
		//--------------------------------------------------------------------

		public function formulario($id) {

			$dados['method'] = is_null($id) ? 'post' : 'put';
			$dados['row'] = $this -> banner_model -> getAll($id) -> get() -> getRow();
			return $this -> view('banners/formulario', $dados);

		}

		//--------------------------------------------------------------------

		public function insert() {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $this -> banner_model -> create() ) {
				$msg = 'Banner adicionado com sucesso!';
				$status = 'success';
				$type = 'back';
			} else {
				$status = 'error';
				$fields = $this -> banner_model -> errors();
			}

			echo json_encode(['status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type]);

		}

		public function update() {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $this -> banner_model -> edit() ) {
				$msg = 'Banner atualizado com sucesso!';
				$status = 'success';
			} else {
				$status = 'error';
				$fields = $this -> banner_model -> errors();
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

			if ( $msg = $this -> banner_model -> updateResource($resource) ) {
				$status = 'success';
			} else {
				$status = 'error';
				$fields = $this -> banner_model -> errors();
			}

			echo json_encode([ 'status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type ]);

		}

		//--------------------------------------------------------------------

		public function delete($id) {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $count = $this -> banner_model -> remove() ){
				$status = 'success';
				$msg = $count . ' ' . ($count > 1 ? 'banners removidos' : 'banner removido') . '.';
			} else{
				$status = 'error';
				$msg = 'Não foi possível remover todos os banners selecionados.';
			}

			echo json_encode([ 'status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type ]);

		}

		//--------------------------------------------------------------------

		/**
		 * 
		 * !!!NAO EXCLUIR ISSO ATÉ FIXAR COMO SERÁ PROGRAMADO O SISTEMA!!!
		 * 
		 * Apenas exemplo para saber como serão realizadas as consultas dos dados
		 * para envio destes para os templates 
		 */
		// public function vw_formulario() {

		// 	$dados = ['nome' => 'alisson', 'id' => '1'];

		// 	$dados['grupos'] = [
		// 		['id' => '1', 'grupo' => 'Grupo 1', 'selected' => false],
		// 		[ 'id' => '2', 'grupo' => 'Grupo 2', 'selected' => false],
		// 		[ 'id' => '3', 'grupo' => 'Grupo 3', 'selected' => false],
		// 		[ 'id' => '4', 'grupo' => 'Grupo 4', 'selected' => 'selected="selected"'],
		// 		[ 'id' => '5', 'grupo' => 'Grupo 5', 'selected' => false],
		// 		[ 'id' => '6', 'grupo' => 'Grupo 6', 'selected' => false]
		// 	];

		// 	$dados['usuario'] = $this -> template('usuarios/formulario', $dados);

		// 	return $this -> view('welcome_message', $dados); 

		// }
		
		//--------------------------------------------------------------------
		
	}
	
}