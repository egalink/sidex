<?php namespace Sidex\Core\Framework;

use \Sidex\Core\Framework\ErrorExceptionHandler;
use \Sidex\Core\Framework\Log;

class Application {

    /**
     * Application config parameters.
     *
     * @var array
     */
    protected $config = array();

    /**
     * Constructor.
     *
     * @param  array  $config
     */
    public function __construct(array $config = array())
    {
        if (empty($config) === true)
            die("You must provide an array with the necessary settings to run the application.");
        else $this->config = $config;

        // configure the error exception handler and initialize it:
        $this->runApplicationErrorHandler();
    }

    /**
     * Run the application.
     *
     * @return void
     */
    public function run()
    {
        exit("Hi my friend, this framework is under construction.");/*
        $frontController = new \Sidex\Http\Controller\FrontController($this->config);
        $frontController->run();/***/
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
    protected function runApplicationErrorHandler()
    {
        $errorExceptionHandler = new ErrorExceptionHandler;
        $errorExceptionHandler->run(function($e) {
            Log::error($e);
            header('HTTP/1.1 500 Internal Server Error');
            echo(sprintf('%s in %s (%d)',
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            ));
        });
    }

    // end class...
}

/* End of file Application.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Application.php */
