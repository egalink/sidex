<?php  if ( ! defined('APPATH')) exit('No direct script access allowed.');


/*
 *-----------------------------------------------------------------------------
 * ADDING ADDITIONAL PHP FUNCTIONS
 *-----------------------------------------------------------------------------
 *
 * The additional php functions for your application.
 *
 */

require __DIR__ . '/functions.php';


/*
 *-----------------------------------------------------------------------------
 * REGISTER THE SIDEX AUTO LOADER
 *-----------------------------------------------------------------------------
 *
 * Sidex provides a convenient automatically class loader for our
 * application. So that we do not have to worry about the loading of any our
 * classes manually.
 *
 * We just need to utilize it!
 *
 */

require __DIR__ . '/autoload.php';


/*
 * ----------------------------------------------------------------------------
 * TURN ON THE LIGHTS
 * ----------------------------------------------------------------------------
 *
 * The front controller is responsible for receiving all requests that the user
 * sends to the application, processes the requests, makes a call to the
 * resources and generate results.
 *
 * For now, the front controller use the RESTful pattern.
 *
 */

$sidexConfigFile = require APPATH . 'config/sidex.php';
$frontController = new \Sidex\Http\Controller\FrontController($sidexConfigFile);


/*
 *--------------------------------------------------------------------------
 * RUN THE APPLICATION
 *--------------------------------------------------------------------------
 *
 * Once we have the application, we can simply call the run method, which will
 * execute the request and send the response back to the client's browser
 * allowing them to enjoy the creative and wonderful application.
 *
 */

$frontController->run();


/* End of file start.php */
/* Location: ./(<application folder>/)bootstrap/start.php */

