<?php namespace Sidex\Start\Framework;

use \Sidex\Start\Framework\ErrorExceptionHandler;
use \Sidex\Http\Controller\FrontController;
    // uses: \Sidex\Http\Request\Url as Url,
    // uses: \Sidex\Http\Controller\FrontControllerInterface as FrontControllerInterface;

class Application {

    /**
     * The main array of config values.
     *
     * @var array
     */
    protected $config = array();

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
     * @param  array  $config
     */
    public function __construct(array $config = array())
    {
        if (empty($config) === true)
            die("You must provide an array with the necessary settings for the application.");
        else $this->config = $config;

        // 1.- set the error handler:
        // 2.- set the exception error handler for logging errors and shutdown
        //     the application:
        $this->setExceptionErrorHandler();
    }

    /**
     * Run the application.
     *
     * @return void
     */
    public function run()
    {
        $this->frontController = new FrontController($this->config);
        $this->frontController->run();
    }

    /**
     * Create a instance of ErrorExceptionHandler class.
     *
     * 1.- set the error handler.
     * 2.- set the exception error handler for logging errors and shutdown
     *     the application.
     *
     * @access protected
     */
    protected function setExceptionErrorHandler()
    {
        $exceptionErrorHandler = new ErrorExceptionHandler($this->config);
    }

    // end class...
}

/* End of file Application.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Application.php */
