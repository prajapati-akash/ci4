<?php

namespace Config;

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
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// api

$routes->resource('api/user', ['websafe' => 1, 'controller' => 'Api\UserController']);
$routes->resource('api/candidate', ['websafe' => 1, 'controller' => 'Api\CandidateController']);
// $routes->resource('api', ['websafe' => 1, 'controller' => 'UserApi']);  // : done

// cron job test 

// $routes->cli('cronjob/(:segment)', 'CronJob\Testcronjob::message/$1');

// user page

$routes->group('', ['filter' => 'register_filter' ], function($routes){

	$routes->match(['get', 'post'], '/', 'Login::index', ['as' => 'user_login']);
	$routes->match(['get', 'post'], 'login/index', 'Login::index');
	$routes->match(['get', 'post'],'registration', 'Registration::index');

});


$routes->group('', ['filter' => 'auth_filter'], function($routes){
	
	$routes->add('dashboard', 'Dashboard::index', ['as' => 'user_dashboard']);
	$routes->get('logout', 'Dashboard::logout');
	$routes->add('dashboard/ajaxrequest', 'Dashboard::ajaxrequest');

	$routes->match(['get', 'post'], 'candidate/add', 'Candidate::add');
	$routes->post('candidate/edit', 'Candidate::edit');
	$routes->match(['get', 'post'], 'candidate/delete/(:segment)', 'Candidate::delete/$1');
	$routes->add('candidate/update', 'Candidate::update');
	$routes->add('candidate/profile', 'Candidate::profile');
	
});


//admin page

$routes->group('admin',['filter' => 'admin_login'], function($routes){
	
	$routes->add('dashboard', 'Admin\Dashboard::index', ['as' => 'admin_dashboard']);

	$routes->add('logout', 'Admin\Admin_BaseController::logout');
	$routes->post('dashboard/adminajax', 'Admin\Dashboard::adminajax');
	$routes->post('dashboard/status', 'Admin\Dashboard::status');
}); 

	 

$routes->group('', ['filter' => 'admin_register'], function($routes){
	$routes->add('admin', 'Admin\Login::index', ['as' => 'admin_login']);
	$routes->add('admin/login', 'Admin\Login::index');
});
/*
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
