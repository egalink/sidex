<?php  if ( ! defined('APPPATH')) exit('No direct script access allowed.');


/*
 *-----------------------------------------------------------------------------
 * ADDING ADDITIONAL FUNCTIONS
 *-----------------------------------------------------------------------------
 *
 * The additional functions for your application.
 *
 */

require __DIR__ . '/functions.php';


/*
 *-----------------------------------------------------------------------------
 * TURN ON THE LIGHTS
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
 * INITIALIZE THE FRONT CONTROLLER
 * ----------------------------------------------------------------------------
 *
 * The front controller is responsible for receiving all requests that the user
 * sends to the application, processes the requests, makes a call to the
 * resources and generate results.
 *
 * For now, the front controller use the pattern RESTful
 * (Representational State Transfer Complete).
 *
 */
$frontController = new \Sidex\Http\Controller\FrontController(require application_path('config/application.php'));


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
