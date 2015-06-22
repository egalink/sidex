<?php namespace Sidex\Framework\Start;

use Sidex\Framework\Controller\FrontController;
use Sidex\Framework\Auth\Session;

class Application {

    /**
     * Sidex\Framework\Controller\FrontController Object
     *
     * @access public
     */
    public $fc;

    /**
     * Sidex\Framework\Auth\Session Object
     *
     * @access public
     */
    public $ss;

    /**
     * Constructor.
     *
     * @param  array  $config
     */
    public function __construct(array $config = array())
    {
        $this->ss = new Session($config);
        $this->fc = new FrontController($config);
    }

    /**
     * Run the application.
     *
     * @access public
     */
    public function run()
    {
        $this->fc->run();
        $this->ss->run();
    }

    // end class...
}

/* End of file Application.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Application.php */
