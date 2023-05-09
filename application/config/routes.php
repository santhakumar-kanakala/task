<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main/home'; 

$route['home'] = 'main/home';
$route['list'] = 'main/list';
$route['trash'] = 'main/trash';


$route['api/users'] = 'api/apiu/index';
$route['api/users/add'] = 'api/apiu/createUser';
$route['api/users/edit/(:any)'] = 'api/apiu/editUser/$1';
$route['api/users/update/(:any)'] = 'api/apiu/updateUser/$1';
$route['api/users/delete'] = 'api/apiu/userDelete';
 

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;