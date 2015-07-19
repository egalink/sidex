<?php

/*
 * ----------------------------------------------------------------------------
 * SIDEX - The little son of PHP developers.
 * ----------------------------------------------------------------------------
 *
 * @package  Sidex
 * @version  1.0.0
 * @author   Edgar Jakim Hernández Arrieta  <egalink@gmail.com>
 *
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

// the name of this file
define('FCNAME', pathinfo(__FILE__, PATHINFO_BASENAME));

// path to the front controller (this file)
define('FCPATH', str_replace('\\', '/', __DIR__ . '/'));


/*
 * ----------------------------------------------------------------------------
 * PATH TO APPLICATION FOLDER:
 * ----------------------------------------------------------------------------
 *
 * Let's get to find the application folder and set the path constant to this.
 *
 */

if ($applicationPath = realpath($applicationPath)) {
    $applicationPath = str_replace('\\', '/', $applicationPath . '/');
}

is_dir($applicationPath)
    or die("Your application folder path does not appear to be set correctly.");

// the real path to the application folder:
define('APPATH', $applicationPath);


/*
 * ----------------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * ----------------------------------------------------------------------------
 *
 * And away we go...
 *
 */

require_once APPATH . 'bootstrap/start.php';


/* End of file index.php */
/* Location: ./(<server folder>/)index.php */
