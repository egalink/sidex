<?php require __DIR__ . '/Sidex/Framework/Start/ClassLoader.php';

class Autoload extends ClassLoader {

    /**
     * Constructor.
     *
     * @access public
     */
    public function __construct()
    {
        $this->configure(require APPATH . 'config/autoload.php');
    }

    // end class...
}

return new Autoload;

/* End of file autoload.php */
/* Location: ./(<application folder>/)libraries/autoload.php */
