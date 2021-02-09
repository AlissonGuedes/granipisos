<?php

namespace App\Controllers {

	use \App\Models\ServicoModel;

	class Servicos extends AppController
	{

		//--------------------------------------------------------------------

		public function __construct() {

			$this -> servico_model = new ServicoModel();

		}

		//--------------------------------------------------------------------

		public function index() {


			if ( isAjax() )
			{

				$dados['rows'] = $this -> servico_model -> getAll();
				$dados['numRows']  = $this -> servico_model -> numRows();
				return $this -> json('servicos/datatable', $dados);

			}

			return $this -> view('servicos/index');

		}

		//--------------------------------------------------------------------

		public function formulario($id) {

			$dados['method'] = is_null($id) ? 'post' : 'put';
			$dados['row'] = $this -> servico_model -> getAll($id) -> get() -> getRow();
			$dados['categorias'] = $this -> servico_model -> getCategorias();
			return $this -> view('servicos/formulario', $dados);

		}

		//--------------------------------------------------------------------

		public function insert() {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $this -> servico_model -> create() ) {
				$msg = 'Servico adicionado com sucesso!';
				$status = 'success';
				$type = 'back';
			} else {
				$status = 'error';
				$fields = $this -> servico_model -> errors();
			}

			echo json_encode(['status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type]);

		}

		public function update() {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $this -> servico_model -> edit() ) {
				$msg = 'Servico atualizado com sucesso!';
				$status = 'success';
			} else {
				$status = 'error';
				$fields = $this -> servico_model -> errors();
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

			if ( $msg = $this -> servico_model -> updateResource($resource) ) {
				$status = 'success';
			} else {
				$status = 'error';
				$fields = $this -> servico_model -> errors();
			}

			echo json_encode([ 'status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type ]);

		}

		//--------------------------------------------------------------------

		public function delete($id) {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $count = $this -> servico_model -> remove() ){
				$status = 'success';
				$msg = $count . ' ' . ($count > 1 ? 'servicos removidos' : 'servico removido') . '.';
			} else{
				$status = 'error';
				$msg = 'Não foi possível remover todos os servicos selecionados.';
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