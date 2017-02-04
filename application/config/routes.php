<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "main";
$route['friends'] = 'friends';
$route['user/(:any)'] = 'users/user/$1';
$route['404_override'] = '';

//end of routes.php