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
 * The first thing we will do is create a new Sidex application instance which
 * serves as the "glue" for all the components of Sidex, and is the
 * IoC container for the system binding all of the various parts.
 *
 */

$app = new \Sidex\Start\Framework\Application(require APPATH . 'config/sidex.php');


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

$app->run();


/* End of file start.php */
/* Location: ./(<application folder>/)bootstrap/start.php */

