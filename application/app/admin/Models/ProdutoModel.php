<?php

namespace App\Models {

	use \CodeIgniter\Model;

	class ProdutoModel extends AppModel {

		/**
		 * Nome da tabela do banco de dados a ser utilizada
		 * 
		 * @var string $table
		 */
		protected $table = 'tb_produto';

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
		protected $returnType = '\App\Entities\Produto';

		/**
		 * Validação para formulários
		 * 
		 * @var array $validationClass
		 */
		protected $validationClass = '\App\Validations\ProdutoValidation';
		
		/**
		 * Especificar quais colunas da tabela serão ordenadas
		 * 
		 * @var array $order
		 */
		protected $order = [
			null,
			'id',
			'nome',
			'(SELECT categoria FROM tb_produto_categoria WHERE tb_produto_categoria.id = tb_produto.id_categoria)',
			'status',
			null
		];

		//--------------------------------------------------------------------

		public function getAll($find = null) {

			$this -> select('tb_produto.id, tb_produto.id_categoria, tb_produto.nome, tb_produto.descricao, tb_produto.modo_uso, tb_produto.imagem, tb_produto.status, tb_produto_categoria.categoria');

			$this -> join('tb_produto_categoria', 'tb_produto_categoria.id = tb_produto.id_categoria', 'left');

			if ( !is_null($find) ) {
				$this -> where('tb_produto.id', $find);
				return $this;
			}

			if ( isset($_GET['search']['value']) && ! empty($_GET['search']['value'])) {

				$search = trim($_GET['search']['value']);

				$this -> groupStart();

				$this -> orLike('tb_produto.id', $search);
				$this -> orLike('tb_produto.nome', $search);
				$this -> orLike('tb_produto_categoria.categoria', $search);
				$this -> orLike('tb_produto.descricao', $search);

				$this -> groupEnd();

			}

			if ( isset($_GET['start']) ) {
				$this -> limit($_GET['length']);
			}

			if ( isset($_GET['length']) ) {
				$this -> offset($_GET['start']);
			}

			// Order By
            if (isset($_GET['order']) && $_GET['order'][0]['column'] != 0 ) {
                $orderBy[$this -> order[$_GET['order'][0]['column']]] = $_GET['order'][0]['dir'];
			} else {
				$orderBy[$this -> order[5]] = 'desc';
				$orderBy[$this -> order[2]] = 'asc';
				$orderBy[$this -> order[4]] = 'desc';
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
						$msg = count($id) . ' ' . (count($id) > 1 ? 'produto desbloqueados' : 'produto desbloqueado') . '.';
					else
						$msg = count($id) . ' ' . (count($id) > 1 ? 'produtos bloqueados' : 'produto bloqueado') . '.';
				break;
			}

			return $msg;

		}

		public function getCategorias() {
			$this -> select('*') -> from('tb_produto_categoria', true) -> where('status', '1');
			return $this;
		}
	}

}
