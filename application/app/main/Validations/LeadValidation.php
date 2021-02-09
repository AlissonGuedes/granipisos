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
				'email',
				'telefone',
			);

		}

		public function setRules() {

			$validate['nome'] = ['trim', 'required'];
			$validate['email'] = empty($_POST['email']) ? 'required' : 'trim';
			$validate['telefone'] = empty($_POST['telefone']) ? 'required' : 'trim';

			return $validate;

		}

	}

}
