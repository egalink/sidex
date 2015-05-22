<?php if ( ! defined('APPATH')) exit('No direct script access allowed.');

$dbDriver = 'mysql';
$database = array();

$database['mysql'] = array(

    'dsn'       => "mysql:host=127.0.0.1;dbname=sidex",
    'username'  => "root",
    'password'  => "",

    'queryes'   => array(
        "SET SESSION sql_mode = 'STRICT_ALL_TABLES';",
        "SET names 'utf8' COLLATE 'utf8_general_ci';",
    ),

    'options'   => array(
        PDO::ATTR_CASE                  => PDO::CASE_NATURAL,
        PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_ORACLE_NULLS          => PDO::NULL_NATURAL,
        PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES      => false,
        PDO::ATTR_STRINGIFY_FETCHES     => false,
    ),

    'driver' => 'mysql',

);

return $database[$dbDriver];

/* End of file database.php */
/* Location: ./(<application folder>/)config/database.php */
