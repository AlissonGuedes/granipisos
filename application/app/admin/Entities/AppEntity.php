<?php

namespace App\Entities {
	
	use \CodeIgniter\Entity;

	class AppEntity extends Entity {

		protected $config;
		protected $allowedFields = [];
	
		public function __construct() {

			$this -> request = \Config\Services :: request();

		}
	
		public function getAllowedFields() {
			return $this -> setAllowedFields();
		}

		public function fill($data = null)
		{

			if ( !$data )
				return FALSE;
 

			// Obter os dados vindos do formulário
			foreach ( $data as $key => $val )
			{

				$k = $this -> mapProperty($key);

				$set = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $k)));
				$get = 'get' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $k)));

				if ( method_exists($this, $set) && ! is_null($set) )
				{

					if ( ! is_array($val) )
					{
						$this -> $set($data[$key]);
						$this -> attributes[$k] = $this -> $get();
					}
					else
					{

						if ( isset($_POST[$key]) )
						{
							$this -> $set($val);
							$this -> attributes[$k] = $this -> $get();
						}
						elseif ( isset($_FILES[$key]) )
						{
							$this -> $set($data);
							$this -> attributes[$k] = $this -> $get();
						}

					}

				}

			}

			$vars = get_class_vars(get_class($this));

			foreach ( $vars as $key => $val ) {

				$set = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));
				$get = 'get' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));

				if ( method_exists($this, $set) && method_exists($this, $get) && ! in_array($key, array_keys($this -> attributes)) )
				{
					
					$this -> $set($val);
					$this -> attributes[$key] = $this -> $get();

				}

			}

			return $this -> attributes;

		}

	}

}
