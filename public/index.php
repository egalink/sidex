<?php

/*
 * ----------------------------------------------------------------------------
 * SIDEX - The little son of PHP developers.
 * ----------------------------------------------------------------------------
 *
 * @package  Sidex
 * @version  0.0.5
 * @author   Edgar Jakim Hernández Arrieta  <egalink@gmail.com>
 */


/*
 * ----------------------------------------------------------------------------
 * APPLICATION FOLDER NAME
 * ----------------------------------------------------------------------------
 *
 * The application folder is where you will do most of your application
 * development.
 *
 */

$applicationPath = '../application';


/*
 * ----------------------------------------------------------------------------
 * PATH CONSTANTS
 * ----------------------------------------------------------------------------
 *
 * Now that we know the path, set the main path constants.
 *
 */

// The name of this file:
define('FCNAME', pathinfo(__FILE__, PATHINFO_BASENAME));

// Path to the front controller (this file):
define('FCPATH', dirname(__FILE__) . '/');


/*
 * ----------------------------------------------------------------------------
 * PATH TO APPLICATION FOLDER:
 * ----------------------------------------------------------------------------
 *
 * The path to the "application" folder:
 *
 */

if ($applicationPath = realpath($applicationPath)) {
    $applicationPath.= '/';
}

if ( ! is_dir($applicationPath)) {
    exit("Your application folder path does not appear to be set correctly in: " . __FILE__);
}

define('APPPATH', $applicationPath);


/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 *
 */
require_once APPPATH . 'bootstrap/start.php';

/* End of file index.php */
/* Location: ./(<server folder>/)index.php */
