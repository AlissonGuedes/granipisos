<?php

namespace App\Validations
{

	class BannerValidation extends AppValidation {

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
				(isset($_POST['autor']) && $_POST['autor'] === $_SESSION[USERDATA]['id'] ? 'id_autor' : NULL),
				'titulo',
				'alias',
				'descricao',
				'url',
				( ! empty($_FILES['imagem']) ? 'imagem' : NULL),
				( ! empty($_FILES['imagem']) ? 'original_name' : NULL),
				( ! empty($_FILES['imagem']) ? 'imgsize' : NULL),
				'status'
			);

		}

		public function setRules() {

			$validate['titulo'] = ['trim', 'required'];

			if ( isset($_POST['_method']) && $_POST['_method'] === 'post' && empty($_FILES['imagem']))
				$validate['imagem'] = array('trim', 'required');
			// elseif ( $_POST['_method'] === 'put' && !empty($_FILES['imagem']))
				// $validate['imagem'] = array('trim', 'is_uni');
			
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
		// public function setRules()
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
