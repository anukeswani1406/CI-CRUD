<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['update'] = 'welcome/update';
$route['edit'] = 'welcome/edit';
$route['delete'] = 'welcome/delete';
$route['fetch'] = 'welcome/fetch';
$route['insert'] = 'welcome/insert';
$route['/'] = 'welcome/index';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
