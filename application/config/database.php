<?php  if ( ! defined('APPATH')) exit('No direct script access allowed.');

$dbDriver = 'mysql';
$database = array();

$database['mysql'] = array(

    'dsn'       => "mysql:host=localhost;dbname=aeropuerto",
    'username'  => "root",
    'password'  => "mysqlroot",

    'queryes'   => array(
        "SET names 'utf8' COLLATE 'utf8_unicode_ci';",
        "SET lc_time_names = 'es_ES';",
    ),

    'options'   => array(
        PDO::ATTR_CASE              => PDO::CASE_NATURAL,
        PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_ORACLE_NULLS      => PDO::NULL_NATURAL,
        PDO::ATTR_EMULATE_PREPARES  => false,
        PDO::ATTR_STRINGIFY_FETCHES => false,
    ),

    'driver' => 'mysql',

);

return $database[$dbDriver];

/* End of file database.php */
/* Location: ./(<application folder>/)config/database.php */
