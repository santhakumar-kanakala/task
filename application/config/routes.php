<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main/home'; 

$route['home'] = 'main/home';
$route['list'] = 'main/list';
$route['trash'] = 'main/trash';


$route['api/users'] = 'api/apiu/index_get';
$route['api/users/add'] = 'api/apiu/createUser_post';
 

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;