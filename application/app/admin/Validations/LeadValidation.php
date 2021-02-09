<?php

namespace App\Validations
{

	class LeadValidation extends AppValidation {

		/**
		 * Um array de nomes de campos que podem ser
		 * alterados pelo usuário em inserts/updates.
		 *
		 * @var array
		 */
		public function getAllowedFields()
		{

			if ( ! isset($_POST['_method']) )
				return array();

			return array(
				'nome',
				'descricao',
				'id_categoria',
				( ! empty($_FILES['imagem']) ? 'imagem' : NULL),
				'status'
			);

		}

		public function getRules() {

			$validate['nome'] = ['trim', 'required'];
			// $validate['categoria'] = ['trim', 'required'];
			// $validate['descricao'] = ['trim', 'required'];

			if ( isset($_POST['_method']) && $_POST['_method'] === 'post' && empty($_FILES['imagem']))
				$validate['imagem'] = array('trim', 'required');
			
			return $validate;

		}

		/**
		 * Regras usadas para validar um dado nos métodos
		 * insert, update e save.
		 * O array deve conter o formato de dados passado
		 * para a biblioteca de validação.
		 *
		 * @var array
		 */
		// public function getRules()
		// {

			// if ( ! isset($_POST['_method']) )
			// 	return array();

			// $image_rules = 'trim';

			// if ( $_POST['_method'] === 'post' )
			// 	$image_rules = 'required|max_size[imagem,1024]';
			// elseif ( ! empty($_FILES['imagem']) )
			// 	$image_rules = 'max_size[imagem,1024]';

			// return array(
			// 	'titulo' => 'trim',
			// 	'imagem' => $image_rules
			// );

		// }

	}

}
