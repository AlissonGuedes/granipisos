<?php

namespace App\Validations
{

	class ClienteValidation extends AppValidation {

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
				'site',
				( ! empty($_FILES['imagem']) ? 'imagem' : NULL),
				// 'telefone',
				// 'cidade',
			);

		}

		public function getRules() {

			$validate = [
				'nome' => [
					'rules' => ['trim', 'required'],
					'errors' => [
						'required' => 'O nome é obrigatório.'
					]
				],
			];

			if ( !empty($_POST['site']) ) {
				$validate['site'] = [
					'rules' => ['trim', 'valid_url'],
					'errors' => [
						'valid_url' => 'Informe um URL válido.'
					]
				];
			}

			if ( isset($_POST['_method']) && $_POST['_method'] === 'post' && empty($_FILES['imagem']))
				$validate['imagem'] = array('trim', 'required');

			// 'email' => [
			// 	'rules' => ['trim', 'required', 'is_unique[tb_cliente.email]'],
			// 	'errors' => [
			// 		'required' => 'O e-mail é obrigatório',
			// 		'is_unique' => 'E-mail já cadastrado'
			// 	]
			// ],
			// 'telefone' => [
			// 	'rules' => ['trim', 'required', 'is_unique[tb_cliente.telefone]'],
			// 	'errors' => [
			// 		'required' => 'O Telefone é obrigatório',
			// 		'is_unique' => 'Telefone já cadastrado'
			// 	]
			// ],
			// 'cidade' => [
			// 	'rules' => 'trim|required',
			// 	'errors' => [
			// 		'required' => 'Cidade de atuação é obrigatória'
			// 	]
			// ]

			return $validate;

		}

	}

}
