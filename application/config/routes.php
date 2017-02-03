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
$route['(:num)'] = 'blogie/index/(:num)';
$route['post'] = 'blogie/index';
$route['post/(:num)'] = 'blogie/view/$1';
$route['post/love/(:num)'] = 'admin/admin/love/$1';
$route['post/like/(:num)'] = 'admin/admin/like/$1';
$route['post/'] = 'blogie/category/name';


$route['admin'] = 'admin/admin';
$route['admin/add'] = 'admin/admin/add';
$route['admin/edit'] = 'admin/admin/edit';
$route['admin/edit/(:any)'] = 'admin/admin/edit/(:any)';
$route['admin/update/(:num)'] = 'admin/admin/update/$1';
$route['admin/delete/(:num)'] = 'admin/admin/delete/$1';
$route['admin/play/(:num)'] = 'admin/admin/play/$1';
$route['admin/play/(:num)/(:any)'] = 'admin/admin/play/$1/$2';
$route['admin/pause/(:num)'] = 'admin/admin/pause/$1';
$route['admin/pause/(:num)/(:any)'] = 'admin/admin/pause/$1/$2';
$route['admin/monitor'] = 'admin/admin/monitor';
$route['admin/login'] = 'admin/admin/login';
$route['admin/logout'] = 'admin/admin/logout';
$route['admin/signup'] = 'admin/admin/signup';
$route['default_controller'] = 'blogie/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
