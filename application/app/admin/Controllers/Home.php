<?php

namespace App\Controllers {
	
	use \App\Models\BannerModel;
	use \App\Models\ProdutoModel;
	use \App\Models\ProdutoCategoriaModel;
	use \App\Models\LeadModel;
	use \App\Models\DistribuidorModel;
	use \App\Models\EmailModel;
	
	class Home extends AppController
	{

		public function __construct() {

			$this -> banner_model = new BannerModel();
			$this -> categoria_model = new ProdutoCategoriaModel();
			$this -> produto_model = new ProdutoModel();
			$this -> leads_model = new LeadModel();
			$this -> distribuidor_model = new DistribuidorModel();
			$this -> email_model = new EmailModel();

		}

		//--------------------------------------------------------------------

		public function index() {

			$dados['total_categorias'] = $this -> categoria_model -> getAll() -> numRows();
			$dados['total_produtos'] = $this -> produto_model -> getAll() -> numRows();
			$dados['total_intencoes'] = $this -> leads_model -> getAll() -> numRows();
			$dados['total_distribuidores'] = $this -> distribuidor_model -> getAll() -> numRows();
			$dados['total_emails'] = $this -> email_model -> getAll() -> numRows();
			$dados['total_banners'] = $this -> banner_model -> getAll() -> numRows();
			return $this -> view('dashboard', $dados);

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
