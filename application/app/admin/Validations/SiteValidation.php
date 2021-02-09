<?php 

namespace App\Validations {

	class SiteValidation extends AppValidation {

		public function getAllowedFields() {

			$this -> allowedFields =  [
				'name',
				'title',
				'url',
				'description',
				'quem_somos',
				( ! empty($_POST['quem_somos_imagem']) ? 'quem_somos_imagem' : NULL ),
				'keywords',
				'custodian',
				'expires',
				'revisit_after',
				'rating',
				'robots',
				'theme_color',
				( ! empty($_POST['logomarca']) ? 'logomarca' : NULL ),
				'language',
				'msg_manutencao',
				'msg_suspensao',
				'manutencao',
				'bloqueado',
				'force_www',
				'force_https'
			];

			return $this -> allowedFields;

		}

		public function getRules() {

			$validate = [];

			// $validate['nome'] = ['trim', 'required'];
			// $validate['login'] = array('trim', 'required', 'is_unique[tb_usuario.login,id,{id}]');
			// $validate['email'] = array('trim', 'required', 'is_unique[tb_usuario.email,id,{id}]');
			
			return $validate;

		}

	}

}