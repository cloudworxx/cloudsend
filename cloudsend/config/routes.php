<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/**
 * Admin Routes 
 */
$route['admin/(:any)'] = "$1";

/**
 * Public Link Routes 
 */
$route['public'] = 'publiclib/index';
$route['public/login'] = 'publiclib/error';
$route['public/login/(:any)'] = 'publiclib/login/$1';
$route['public/download'] = 'publiclib/error';
$route['public/download/(:any)'] = 'publiclib/download/$1';
$route['public/verify'] = 'publiclib/verify';
$route['public/error'] = 'publiclib/error';
$route['public/preview/(:any)'] = 'publiclib/preview';
$route['public/(:any)'] = 'publiclib/index/$1';

/**
 * Public Upload Routes
 */
$route['request'] = 'request/index';
$route['request/error'] = 'request/error';
$route['request/upload'] = 'request/upload';
$route['request/finished'] = 'request/finished';
$route['request/(:any)'] = 'request/index/$1';

/**
 * Installer
 */
$route['installer/(:any)'] = "installer/$1";

/**
 * Frontend Controller 
 */

$route['stream/(:any)'] = "frontend/bgstream/$1";
$route['(:any)/login'] = "frontend/login";
$route['(:any)/publicfiles'] = "frontend/publicfiles";
$route['(:any)/userfiles'] = "frontend/userfiles";
$route['(:any)/upload'] = "frontend/upload";
$route['(:any)/download/(:any)'] = "frontend/download";
$route['(:any)/uploads'] = "frontend/myuploads";
$route['(:any)/logout'] = "frontend/logout";
$route['(:any)/error'] = "frontend/error";
$route['(:any)/verify'] = "frontend/verify";
$route['(:any)/finished'] = "frontend/finished";
$route['(:any)/preview/(:any)'] = "frontend/preview";
$route['(:any)/settings'] = "frontend/settings";
$route['(:any)/save_settings'] = "frontend/save_settings";
$route['(:any)'] = "frontend/index";

/**
 * Default / 404 Controller 
 */
$route['default_controller'] = "frontend";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */