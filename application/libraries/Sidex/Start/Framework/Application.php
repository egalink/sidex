<?php namespace Sidex\Start\Framework;

use \Sidex\Http\Controller\FrontController;
    // uses: \Sidex\Http\Request\Url as Url,
    // uses: \Sidex\Http\Controller\FrontControllerInterface as FrontControllerInterface;

class Application {

    /**
     * A Front Controller class instance.
     *
     * @var \Sidex\Http\Controller\FrontController Object
     */
    protected $frontController;

    /**
     * Class constructor.
     *
     * @access public
     */
    function __construct()
    {
        $config = require APPATH . 'config/sidex.php';
        $this->frontController = new FrontController($config);
    }

    /**
     * Run the application.
     *
     * @return void
     */
    public function run()
    {
        $this->frontController->run();
    }

    // end class...
}

/* End of file Application.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Application.php */
