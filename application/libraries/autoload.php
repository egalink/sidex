<?php if (! defined('APPATH')) exit('No direct script access allowed.');

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

require __DIR__ . '/Sidex/Framework/Start/ClassLoader.php';

class Autoload extends ClassLoader {

    public function __construct()
    {
        $this->configure(require APPATH . 'config/autoload.php');
    }

    // end class...
}

$autoload = new Autoload;
$autoload->register();

/* End of file autoload.php */
/* Location: ./(<application folder>/)libraries/autoload.php */
