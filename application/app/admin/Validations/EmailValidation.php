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
				'email',
				'telefone',
				'assunto',
				'mensagem',
				'id_reply',
				( ! empty($_FILES['imagem']) ? 'imagem' : NULL),
				( ! empty($_FILES['imagem']) ? 'original_name' : NULL),
				( ! empty($_FILES['imagem']) ? 'imgsize' : NULL),
				'status'
			);

		}

		public function getRules() {

			$validate = [];
			// if ( isset($_POST['_method']) && $_POST['_method'] === 'post' && empty($_FILES['imagem']))
			// 	$validate['imagem'] = array('trim', 'required');
			
			return $validate;

		}

	}

}
