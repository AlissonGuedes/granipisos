<?php

namespace App\Models {

	use \CodeIgniter\Model;

	class ServicoModel extends AppModel {

		/**
		 * Nome da tabela do banco de dados a ser utilizada
		 *
		 * @var string $table
		 */
		protected $table = 'tb_servico';

		/**
		 * A chave primária da tabela
		 *
		 * @var string $primaryKey
		 */
		protected $primaryKey = 'id';

		/**
		 * Classe espelho do banco de dados
		 *
		 * @var string $returnType
		 */
		protected $returnType = '\App\Entities\Servico';

		/**
		 * Validação para formulários
		 *
		 * @var array $validationClass
		 */
		protected $validationClass = '\App\Validations\ServicoValidation';

		/**
		 * Especificar quais colunas da tabela serão ordenadas
		 *
		 * @var array $order
		 */
		protected $order = [
			null,
			'id',
			'nome',
			'status',
			null
		];

		//--------------------------------------------------------------------

		public function getAll($find = null) {

			$this -> select('tb_servico.id, tb_servico.nome, tb_servico.nome_slug, tb_servico.descricao, tb_servico.imagem, tb_servico.status, tb_servico.status');

			// $this -> join('tb_servico', 'tb_servico.id = tb_servico.id_categoria', 'left');

			if ( !is_null($find) && is_numeric($find) ) {
				$this -> where('tb_servico.id', $find);
				return $this;
			}

			$this -> where('tb_servico.status', '1');
			$this -> where('tb_servico.status', '1');

			if ( isset($_GET['search']['value']) && ! empty($_GET['search']['value'])) {

				$search = trim($_GET['search']['value']);

				$this -> groupStart();

				$this -> orLike('tb_servico.id', $search);
				$this -> orLike('tb_servico.nome', $search);
				$this -> orLike('tb_servico.descricao', $search);

				$this -> groupEnd();

			}

			if ( isset($_GET['start']) ) {
				$this -> limit($_GET['length']);
			} else if ( isset($find['limit'] ) ) {
				$this -> limit($find['limit']);
			}

			if ( isset($_GET['length']) ) {
				$this -> offset($_GET['start']);
			}

			// Order By
            if (isset($_GET['order']) && $_GET['order'][0]['column'] != 0 ) {
                $orderBy[$this -> order[$_GET['order'][0]['column']]] = $_GET['order'][0]['dir'];
			} else {
				$orderBy[$this -> order[1]] = 'desc';
				$orderBy[$this -> order[2]] = 'asc';
				$orderBy[$this -> order[3]] = 'desc';
			}

			foreach($orderBy as $key => $val) {
				$this -> orderBy($key, $val);
			}

			return $this;

		}

		public function updateResource($resource) {

			$msg = null;
			$column = $resource;
			$id = $_POST['id'];
			$value = $_POST['value'];

			$this -> builder() -> set($column, $value) -> whereIn('id', $id) -> update();

			switch($resource) {
				case 'status':
					if ( $value )
						$msg = count($id) . ' ' . (count($id) > 1 ? 'servico desbloqueados' : 'servico desbloqueado') . '.';
					else
						$msg = count($id) . ' ' . (count($id) > 1 ? 'servicos bloqueados' : 'servico bloqueado') . '.';
				break;
			}

			return $msg;

		}

		public function getCategorias() {
			$this -> select('*') -> from('tb_servico', true) -> where('status', '1');
			return $this -> get() -> getResult();
		}
	}

}
