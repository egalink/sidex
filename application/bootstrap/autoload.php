<?php  if ( ! defined('APPATH')) exit('No direct script access allowed.');


/*
 *-----------------------------------------------------------------------------
 * REGISTER THE COMPOSER AUTO LOADER
 *-----------------------------------------------------------------------------
 *
 * Composer provides a convenient, automatically generated class loader for our
 * application. We'll require it into the script here so that we do not have to
 * worry about the loading of any our classes manually.
 *
 * We just need to utilize it!
 *
 */

if (file_exists($composerAutoloader = APPATH . 'vendor/autoload.php')) {
        require $composerAutoloader;
}


/*
 * ----------------------------------------------------------------------------
 * THE SIDEX CLASS LOADER
 * ----------------------------------------------------------------------------
 *
 * We register an auto-loader "behind" the Composer loader that can load
 * classes on the fly, even if the composer autoload files have not been
 * regenerated for the application. We'll add it to the stack here.
 *
 * ----------------------------------------------------------------------------
 * For more information: http://www.php-fig.org/psr/psr-0
 *
 */

require_once APPATH . 'libraries/autoload.php';
$ClassLoader = new \Sidex\Autoload\ClassLoader(require APPATH . 'config/autoload.php');
$ClassLoader->register();


/* End of file autoload.php */
/* Location: ./(<application folder>/)bootstrap/autoload.php */
