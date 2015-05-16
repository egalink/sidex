<?php require_once __DIR__ . '/Sidex/Framework/Start/ClassLoader.php';

/*
 *-----------------------------------------------------------------------------
 * THE SIDEX AUTO LOADER
 *-----------------------------------------------------------------------------
 *
 * Sidex provides a convenient automatically class loader for our
 * application.
 *
 * We just need to initialize it!
 *
 */

$classLoader = new ClassLoader(require APPATH . 'config/autoload.php');
$classLoader->register();

/* End of file autoload.php */
/* Location: ./(<application folder>/)libraries/autoload.php */
