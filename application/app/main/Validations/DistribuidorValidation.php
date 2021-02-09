<?php

namespace App\Validations
{

	class DistribuidorValidation extends AppValidation {

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
				'email',
				'telefone',
				'cidade',
			);

		}

		public function setRules() {

			$validate = [
				'nome' => [
					'rules' => ['trim', 'required'],
					'errors' => [
						'required' => 'O nome é obrigatório.'
					]
				],
				'email' => [
					'rules' => ['trim', 'required', 'is_unique[tb_distribuidor.email]'],
					'errors' => [
						'required' => 'O e-mail é obrigatório',
						'is_unique' => 'E-mail já cadastrado'
					]
				],
				'telefone' => [
					'rules' => ['trim', 'required', 'is_unique[tb_distribuidor.telefone]'],
					'errors' => [
						'required' => 'O Telefone é obrigatório',
						'is_unique' => 'Telefone já cadastrado'
					]
				],
				'cidade' => [
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'Cidade de atuação é obrigatória'
					]
				]
			];

			return $validate;

		}

	}

}
