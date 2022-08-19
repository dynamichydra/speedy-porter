<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['admin'] = 'admin/home';
$route['admin/merchant'] = 'admin/customer';
// $route['merchant/report/financial_report/(:any)'] = 'admin/report/financial_report/$1';
$route['register'] = 'home/register';
$route['tracking'] = 'home/tracking';
$route['pricing'] = 'home/pricing';
$route['contact'] = 'home/contact';
$route['about_us'] = 'home/about_us';
$route['terms'] = 'home/terms';
$route['privacy'] = 'home/privacy_policy';
$route['delivery/dashboard'] = 'admin/dashboard';
$route['merchant/dashboard'] = 'admin/dashboard';
$route['merchant/consignment'] = 'admin/consignment';
$route['merchant/consignment/create_delivery'] = 'admin/consignment/create_delivery';
$route['merchant/shiping/index/(:any)'] = 'admin/shiping/index/$1';
$route['merchant/shiping/create/(:any)'] = 'admin/shiping/create/$1';
$route['merchant/shiping_history/index/(:any)'] = 'admin/shiping_history/index/$1';

$route['merchant/shiping_history/details/(:any)'] = 'admin/shiping_history/details/$1';
$route['merchant/profile/(:any)'] = 'admin/customer/profile/$1';

$route['merchant/report/delivery_status'] = 'admin/report/delivery_status';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
