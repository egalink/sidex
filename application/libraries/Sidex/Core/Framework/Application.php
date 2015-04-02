<?php namespace Sidex\Core\Framework;

use \Sidex\Core\Framework\ErrorExceptionHandler;
use \Sidex\Http\Controller\FrontController;
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
        $this->applicationErrorHandler(new ErrorExceptionHandler);
    }

    /**
     * Run the application.
     *
     * @return void
     */
    public function run()
    {
        $frontController = new FrontController($this->config);
        $frontController->run();
    }

    /**
     * This is the error exception handler for the application.
     *
     * @access public
     * @param  ErrorException Object  $e
     * @return void
     */
    public function errorHandler($e)
    {
        ob_clean();
        Log::error($e);
        header('HTTP/1.1 500 Internal Server Error');
        exit(sprintf('%s in %s (%d)',
            $e->getMessage(),
            $e->getFile(),
            $e->getLine()
        ));
    }

    /**
     * Configure the error exception handler to initialize it.
     *
     * 1.- set the global application error handler.
     * 3.- set the exception error handler for logging errors and shutdown
     *     the application.
     *
     * @access protected
     * @param  ErrorExceptionHandler Object  $handler
     */
    protected function applicationErrorHandler(ErrorExceptionHandler $handler)
    {
        $handler->initialize([$this, 'errorHandler']);
    }

    // end class...
}

/* End of file Application.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Application.php */
