<?php 

namespace App\Validations {

	class EmpresaValidation extends AppValidation {

		public function getAllowedFields() {

			$this -> allowedFields =  [
				'email',
				'telefone',
				'celular',
				'facebook',
				'instagram',
				'linkedin',
				'telefone',
				( ! empty($_FILES['quem_somos_imagem']) ? 'quem_somos_imagem' : NULL ),
				( ! empty($_FILES['distribuidor_imagem']) ? 'distribuidor_imagem' : NULL ),
				( ! empty($_FILES['contato_imagem']) ? 'contato_imagem' : NULL ),
				'quem_somos',
			];

			return $this -> allowedFields;

		}

		public function getRules() {

			$validate['facebook'] = empty($_POST['facebook']) ?  'trim' : 'valid_url' ;
			$validate['instagram'] = empty($_POST['instagram']) ? 'trim' : 'valid_url';
			$validate['linkedin'] = empty($_POST['linkedin']) ? 'trim' : 'valid_url';
			$validate['gplus'] = empty($_POST['gplus']) ? 'trim' : 'valid_url';
			$validate['gmaps'] = empty($_POST['gmaps']) ? 'trim' : 'valid_url';

			return $validate;

		}

	}

}
