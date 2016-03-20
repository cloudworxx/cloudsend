<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = '{inst_db_host}';
$db['default']['username'] = '{inst_db_user}';
$db['default']['password'] = '{inst_db_pass}';
$db['default']['database'] = '{inst_db_data}';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '{inst_db_prefix}';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = FALSE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '{TRANS}';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;
