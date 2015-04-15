<?php if (! defined('APPATH')) exit('No direct script access allowed.');

require __DIR__ . '/Sidex/Framework/Start/ClassLoader.php';

class Autoload extends \Sidex\Framework\Start\ClassLoader {

    /**
     * Constructor.
     *
     * @access public
     */
    public function Autoload()
    {
        $this->configure(require APPATH . 'config/autoload.php');
    }

    // end class...
}

return new Autoload;

/* End of file autoload.php */
/* Location: ./(<application folder>/)libraries/autoload.php */
