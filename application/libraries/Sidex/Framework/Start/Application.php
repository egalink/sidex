<?php namespace Sidex\Framework\Start;

use Sidex\Framework\Controller\FrontController;

class Application {

    /**
     * Sidex\Framework\Controller\FrontController Object
     *
     * @access public
     */
    public $fController;

    /**
     * Constructor.
     *
     * @param  array  $config
     */
    public function __construct(array $config = array())
    {
        $this->fController = new FrontController($config);
    }

    /**
     * Run the application.
     *
     * @access public
     */
    public function run()
    {
        $this->fController->run();
    }

    // end class...
}

/* End of file Application.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Application.php */
