<?php

namespace App\Validations
{

	class ProdutoCategoriaValidation extends AppValidation {

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
				'categoria',
				( ! empty($_FILES['imagem']) ? 'imagem' : NULL),
				'status'
			);

		}

		public function getRules() {

			$validate['categoria'] = ['trim', 'required'];
			
			return $validate;

		}

	}

}
