<?php namespace Sidex\Start\Framework;

use \Sidex\Start\Framework\ErrorExceptionHandler;
use \Sidex\Http\Controller\FrontController;
    // uses: \Sidex\Http\Request\Url as Url,
    // uses: \Sidex\Http\Controller\FrontControllerInterface as FrontControllerInterface;

class Application {

    /**
     * Application config parameters.
     *
     * @var array
     */
    protected $config = array();

    /**
     * Class constructor.
     *
     * @access public
     * @param  array  $config
     */
    public function __construct(array $config = array())
    {
        if (empty($config) === true)
            die("You must provide an array with the necessary settings for the application.");
        else $this->config = $config;

        // configure the error exception handler and initialize it:
        $this->setApplicationErrorHandler();
    }

    /**
     * Run the application.
     *
     * @return void
     */
    public function run()
    {
        exit("Hi my friend, this framework is under construction.");
    }

    /**
     * Configure the error exception handler and initialize it.
     *
     * 1.- set the global application error handler.
     * 2.- set the exception error handler for logging errors and shutdown
     *     the application.
     *
     * @access protected
     */
    protected function setApplicationErrorHandler()
    {
        $errorExceptionHandler = new ErrorExceptionHandler;
        $errorExceptionHandler->run(function($e) {
            debug($e);exit;
        });
    }

    // end class...
}

/* End of file Application.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Application.php */
