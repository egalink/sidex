<?php namespace Sidex\Start\Framework;

use Exception;
use \Sidex\Http\Controller\FrontController;
    // uses: \Sidex\Http\Request\Url as Url,
    // uses: \Sidex\Http\Controller\FrontControllerInterface as FrontControllerInterface;

class Application {

    /**
     * A Front Controller class instance.
     *
     * @var \Sidex\Http\Controller\FrontController Object
     */
    protected $FrontController;

    /**
     * constructor de la clase.
     *
     * @access public
     */
    function __construct()
    {
        exit("Hi Sidex application!");
    }

    /**
     * Run the application.
     *
     * @return void
     */
    public function run() {}

    // end class...
}

/* End of file Application.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Application.php */
