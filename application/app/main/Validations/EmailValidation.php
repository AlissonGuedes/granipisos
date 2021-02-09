<?php

namespace App\Validations
{

	class EmailValidation extends AppValidation {

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
				'nome',
				'assunto',
				'email',
				'telefone',
				'mensagem',
			);

		}

		public function setRules() {

			$validate = [
				'nome' => [
					'rules' => ['trim', 'required'],
					'errors' => [
						'required' => 'O nome é obrigatório'
					]
				],
				'email' => [
					'rules' => ['trim', 'required'],
					'errors' => [
						'required' => 'O e-mail é obrigatório'
					]
				],
				'telefone' => [
					'rules' => ['trim', 'required'],
					'errors' => [
						'required' => 'O telefone é obrigatório'
					]
				],
				// 'assunto' => [
				// 	'rules' => ['trim', 'required'],
				// 	'errors' => [
				// 		'required' => 'O assunto é obrigatório'
				// 	]
				// ],
				// 'mensagem' => [
				// 	'rules' => ['trim', 'required'],
				// 	'errors' => [
				// 		'required' => 'A mensagem é obrigatória'
				// 	]
				// ]
			];

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
