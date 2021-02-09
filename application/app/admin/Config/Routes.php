<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$rotas = \Functions\Library::getRoutes();

foreach ( $rotas as $route ) {

	// $type = $route -> type;
	// $routes -> $type($route -> route, $route -> controller);

}

// --------------------------------------------------------------------

// Rotas comuns que não necessitam de sessão
$routes -> add('/admin/dashboard', 'Home::index');
$routes -> add('/admin', 'Home::index');
$routes -> add('/admin/login', 'Login::index');

$routes -> get('/admin/login/(.+)', 'Account::index/$1');
$routes -> post('/admin/login', 'Login::auth');

$routes -> add('/admin/logout', 'Login::logout');

// Banners
$routes -> add('/admin/banners', 'Banners::index');
$routes -> add('/admin/banners/novo', 'Banners::formulario/$1');
$routes -> get('/admin/banners/(:num)', 'Banners::formulario/$1');
$routes -> put('/admin/banners', 'Banners::update/$1');
$routes -> patch('/admin/banners/(:segment)', 'Banners::replace/$1');
$routes -> post('/admin/banners', 'Banners::insert');
$routes -> delete('/admin/banners', 'Banners::delete/$1');

// Quem Somos
$routes -> add('/admin/quemsomos', 'Empresa::index');
$routes -> put('/admin/quemsomos', 'Empresa::update');

// Servicos
$routes -> add('/admin/servicos', 'Servicos::index');
$routes -> add('/admin/servicos/novo', 'Servicos::formulario/$1');
$routes -> get('/admin/servicos/(:num)', 'Servicos::formulario/$1');
$routes -> put('/admin/servicos', 'Servicos::update/$1');
$routes -> patch('/admin/servicos/(:segment)', 'Servicos::replace/$1');
$routes -> post('/admin/servicos', 'Servicos::insert');
$routes -> delete('/admin/servicos', 'Servicos::delete/$1');

// Clientes
$routes -> add('/admin/clientes', 'Clientes::index');
$routes -> add('/admin/clientes/novo', 'Clientes::formulario/$1');
$routes -> get('/admin/clientes/(:num)', 'Clientes::formulario/$1');
$routes -> put('/admin/clientes', 'Clientes::update/$1');
$routes -> patch('/admin/clientes/(:segment)', 'Clientes::replace/$1');
$routes -> post('/admin/clientes', 'Clientes::insert');
$routes -> delete('/admin/clientes', 'Clientes::delete/$1');

// Usuarios
$routes -> add('/admin/usuarios', 'Usuarios::index');
$routes -> add('/admin/usuarios/novo', 'Usuarios::formulario/$1');
$routes -> add('/admin/usuarios/(:num)', 'Usuarios::formulario/$1');
$routes -> put('/admin/usuarios', 'Usuarios::update/$1');
$routes -> patch('/admin/usuarios/(:segment)', 'Usuarios::replace/$1');
$routes -> post('/admin/usuarios', 'Usuarios::insert');
$routes -> delete('/admin/usuarios', 'Usuarios::delete/$1');

// // Email
$routes -> add('/admin/mail', 'Email::index');
$routes -> get('/admin/mail/(:num)', 'Email::show/$1');
$routes -> put('/admin/mail', 'Email::update/$1');
$routes -> patch('/admin/mail/(:segment)', 'Email::replace/$1');
$routes -> post('/admin/mail', 'Email::insert');
$routes -> delete('/admin/mail', 'Email::delete/$1');

// // Intenções
// $routes -> add('/admin/intencoes', 'Leads::index');
// $routes -> get('/admin/intencoes/(:num)', 'Leads::show/$1');
// $routes -> put('/admin/intencoes', 'Leads::update/$1');
// $routes -> patch('/admin/intencoes/(:segment)', 'Leads::replace/$1');
// $routes -> post('/admin/intencoes', 'Leads::insert');
// $routes -> delete('/admin/intencoes', 'Leads::delete/$1');

// // Distribuidores
// $routes -> add('/admin/distribuidores', 'Distribuidores::index');
// $routes -> get('/admin/distribuidores/(:num)', 'Distribuidores::show/$1');
// $routes -> put('/admin/distribuidores', 'Distribuidores::update/$1');
// $routes -> patch('/admin/distribuidores/(:segment)', 'Distribuidores::replace/$1');
// $routes -> post('/admin/distribuidores', 'Distribuidores::insert');
// $routes -> delete('/admin/distribuidores', 'Distribuidores::delete/$1');

// // Categorias
// $routes -> add('/admin/categorias', 'Categorias::index');
// $routes -> add('/admin/categorias/novo', 'Categorias::formulario/$1');
// $routes -> get('/admin/categorias/(:num)', 'Categorias::formulario/$1');
// $routes -> put('/admin/categorias', 'Categorias::update/$1');
// $routes -> patch('/admin/categorias/(:segment)', 'Categorias::replace/$1');
// $routes -> post('/admin/categorias', 'Categorias::insert');
// $routes -> delete('/admin/categorias', 'Categorias::delete/$1');

// // Produtos
// $routes -> add('/admin/produtos', 'Produtos::index');
// $routes -> add('/admin/produtos/novo', 'Produtos::formulario/$1');
// $routes -> get('/admin/produtos/(:num)', 'Produtos::formulario/$1');
// $routes -> put('/admin/produtos', 'Produtos::update/$1');
// $routes -> patch('/admin/produtos/(:segment)', 'Produtos::replace/$1');
// $routes -> post('/admin/produtos', 'Produtos::insert');
// $routes -> delete('/admin/produtos', 'Produtos::delete/$1');

// $routes -> add('/admin/mail/template', 'Email::template_email');
// $routes -> put('/admin/mail/template', 'Email::update_template');

// --------------------------------------------------------------------

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
