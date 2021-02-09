<?php

set_include_path(dirname(__DIR__));

#########################################################################################

if ( isset($_SERVER['ENVIRONMENT']) )
	define('ENVIRONMENT', $_SERVER['ENVIRONMENT']);

$dir_atual = isset($_SERVER['PATH_INFO']) ? explode('/', $_SERVER['PATH_INFO']) : null;

if ( ! is_null($dir_atual) ) 
	array_shift($dir_atual);

$appFolder = ! is_null($dir_atual) && is_dir(get_include_path() . DS . 'app' . DS . $dir_atual[0]) 
	? get_include_path() . DS . 'app' . DS . $dir_atual[0] : get_include_path() . DS . 'app' . DS . 'main';

// Path to the front controller (this file)
define('FCPATH', get_include_path() . DS);
define('BASEPATH', $appFolder . DS);
define('VIEWSPATH', BASEPATH . 'Views' . DS);
define('VIEW_TEMPLATES', VIEWSPATH . 'templates' . DS);

if ( ENVIRONMENT !== 'production')
{
	if ( ! is_dir(BASEPATH) ) {
		exit('Você deve criar o diretório de aplicação em <strong>' . BASEPATH . '</strong>');
	}

	if ( ! is_dir(VIEWSPATH) ) {
		exit('Não foi possível localizar o diretório <strong>' . VIEWSPATH . '</strong>.');
	}

	if ( ! is_dir(VIEW_TEMPLATES) ) {
		exit('Não foi possível localizar o diretório <strong>' . VIEW_TEMPLATES . '</strong>.');
	}
}

#########################################################################################