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
$route['default_controller'] = 'ControllerInfoAplikasi/index';
$route['404_override'] = 'ControllerInfoAplikasi/index';
$route['translate_uri_dashes'] = FALSE;

$route['api/infoaplikasi'] = 'ControllerInfoAplikasi/index';

//Route Autentikasi
$route['api/daftaruser'] = 'ControllerUser/daftaruser';
$route['api/masukuser'] = 'ControllerUser/masukuser';
$route['api/lihatdatauser/(:any)'] = 'ControllerUser/lihatdatauser/(:any)';
$route['api/gantipassworduser'] = 'ControllerUser/gantipassworduser';
$route['api/aktivasiuser/(:any)'] = 'ControllerUser/aktivasiuser/(:any)';
$route['api/resetpassworduser'] = 'ControllerUser/resetpassworduser';
$route['api/aksiresetpassworduser/(:any)'] = 'ControllerUser/aksiresetpassworduser/(:any)';

//Route Pemakai
$route['api/tambahpemakai'] = 'ControllerPemakai/tambahpemakai';
$route['api/lihatpemakai/(:any)'] = 'ControllerPemakai/lihatpemakai/(:any)';
$route['api/lihatsatupemakai/(:any)/(:any)'] = 'ControllerPemakai/lihatsatupemakai/(:any)/(:any)';
$route['api/ubahpemakai/(:any)/(:any)'] = 'ControllerPemakai/ubahpemakai/(:any)/(:any)';
$route['api/hapuspemakai/(:any)/(:any)'] = 'ControllerPemakai/hapuspemakai/(:any)/(:any)';

//Route Alat WO
$route['api/tambahalatwo'] = 'ControllerAlatwo/tambahalatwo';
$route['api/lihatalatwo/(:any)'] = 'ControllerAlatwo/lihatalatwo/(:any)';
$route['api/lihatsatualatwo/(:any)/(:any)'] = 'ControllerAlatwo/lihatsatualatwo/(:any)/(:any)';
$route['api/ubahalatwo/(:any)/(:any)'] = 'ControllerAlatwo/ubahalatwo/(:any)/(:any)';
$route['api/hapusalatwo/(:any)/(:any)'] = 'ControllerAlatwo/hapusalatwo/(:any)/(:any)';

//Router Kerusakan Motor
$route['api/tambahkerusakanmotor'] = 'ControllerKerusakanmotor/tambahkerusakanmotor';
$route['api/lihatkerusakanmotor/(:any)'] = 'ControllerKerusakanmotor/lihatkerusakanmotor/(:any)';
$route['api/lihatsatukerusakanmotor/(:any)/(:any)'] = 'ControllerKerusakanmotor/lihatsatukerusakanmotor/(:any)/(:any)';
$route['api/ubahkerusakanmotor/(:any)/(:any)'] = 'ControllerKerusakanmotor/ubahkerusakanmotor/(:any)/(:any)';
$route['api/hapuskerusakanmotor/(:any)/(:any)'] = 'ControllerKerusakanmotor/hapuskerusakanmotor/(:any)/(:any)';
