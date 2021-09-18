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
// $routes->match(['get','post'],'/', 'Home::login_details', ['filter'=>'noauth']);
$routes->match(['get','post'],'login', 'Home::login_details', ['filter'=>'noauth']);
$routes->get('home', 'Home::dashboard', ['filter'=>'auth']);
// User Model
$routes->match(['get','post'], 'user/create_user', 'User::create_user_details', ['filter'=>'auth']);
$routes->match(['get','post'], 'user/import_users', 'User::import_users_details', ['filter'=>'auth']);
$routes->get('logout', 'Home::logout');

//Assignment Module
$routes->match(['get','post'], 'campaign/campaign_details', 'Campaign::create_campaign_details', ['filter'=>'auth']);
$routes->match(['get','post'], 'assignment/module_details', 'Assignment::create_module_details', ['filter'=>'auth']);
$routes->match(['get','post'], 'assignment/topic_details', 'Assignment::create_topic_details', ['filter'=>'auth']);
$routes->match(['get','post'], 'assignment/topic_assignment_details', 'Assignment::create_topic_assignment_details', ['filter'=>'auth']);

// kunjika
$routes->match(['get','post'], 'campaign/import_data/(:any)', 'Campaign::import_data/$1', ['filter'=>'auth']);
$routes->match(['get','post'], 'campaign/student_data_calls/(:any)', 'Campaign::student_data_call_records/$1', ['filter'=>'auth']);

$routes->match(['get','post'], 'master/products', 'Master::product_details', ['filter'=>'auth']);

//Programs Module
$routes->get('programs','Programs::program_deatils', ['filter'=>'auth']);
$routes->get('programs/program_details/(:any)','Programs::program_module_deatils/$1', ['filter'=>'auth']);
$routes->get('programs/topic_assignment/(:any)','Programs::topic_assignment_deatils/$1', ['filter'=>'auth']);
$routes->post('programs/submit_topic_assignment','Programs::submit_topic_assignment_details', ['filter'=>'auth']);

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
