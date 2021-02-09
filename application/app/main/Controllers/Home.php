<?php

namespace App\Controllers {

	use \App\Models\BannerModel;
	use \App\Models\ServicoModel;

	class Home extends AppController
	{


		//--------------------------------------------------------------------

		public function __construct() {

			$this -> banner_model = new BannerModel();
			$this -> servico_model = new ServicoModel();

		}

		//--------------------------------------------------------------------

		public function index() {

			$dados = [];

			$dados['banners'] = $this -> banner_model -> getAll() -> result();
			$dados['servicos'] = $this -> servico_model -> getAll(['limit' => '6']) -> result();

			return $this -> view('index', $dados);

		}

		//--------------------------------------------------------------------

	}

}