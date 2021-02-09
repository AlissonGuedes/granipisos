<?php

namespace App\Controllers {

	use \App\Models\SiteModel;

	class Configuracoes extends AppController {

		//--------------------------------------------------------------------

		public function __construct() {

			$this -> site_model = new SiteModel();

		}

		//--------------------------------------------------------------------

		public function globais() {

			$dados = [];

			return $this -> view('configuracoes/globais/index', $dados);

		}

		//--------------------------------------------------------------------

		public function form($id) {

			$site = [];

			if ( is_numeric($id) )
				$site = $this -> site_model -> getAll($id);
			else 
				$site= ['status' => '1', 'bloqueado' => '0'];

			echo json_encode($site);

		}

		//--------------------------------------------------------------------

		public function quemsomos() {

			if ( isset($_POST) && ! empty($_POST) ) {
				
				
				$type   = null;
				$status = null;
				$msg	= null;
				$fields = null;
				
				if ( $this -> site_model -> edit() ) {
					$msg = 'Site atualizado com sucesso!';
					$status = 'success';
				} else {
					$status = 'error';
					$fields = $this -> site_model -> errors();
				}

				return json_encode([ 'status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type ]);

			}

			$dados['row'] = $this -> site_model -> getAll(1);
			return $this -> view('configuracoes/quemsomos/index', $dados);

		}

		//--------------------------------------------------------------------

		public function show($id) {

			$dados['users'] = $this -> site_model -> getAll();
			$dados['row'] = $this -> site_model -> getUsers($id);

			return $this -> view('site/index', $dados);

		} 
		
		//--------------------------------------------------------------------

		public function insert() {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $this -> site_model -> create() ) {
				$msg = 'Usuário adicionado com sucesso!';
				$status = 'success';
				$type = 'back';
			} else {
				$status = 'error';
				$fields = $this -> site_model -> errors();
			}

			echo json_encode(['status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type]);

		}

		//--------------------------------------------------------------------

		public function update($id) {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $this -> site_model -> edit() ) {
				$msg = 'Dados atualizados com sucesso!';
				$status = 'success';
			} else {
				$status = 'error';
				$fields = $this -> site_model -> errors();
			}

			echo json_encode([ 'status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type ]);

		}

		//--------------------------------------------------------------------

		public function delete() {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $count = $this -> site_model -> remove() ){
				$status = 'success';
				$msg = $count . ' ' . ($count > 1 ? 'configurações removidas' : 'configuração removida') . '.';
			} else{
				$status = 'error';
				$msg = 'Não foi possível remover todos as configurações selecionadas.';
			}

			echo json_encode([ 'status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type ]);

		}

		//--------------------------------------------------------------------

	}

}