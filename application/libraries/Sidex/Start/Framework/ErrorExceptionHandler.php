<?php namespace Sidex\Start\Framework;

use ErrorException;

class ErrorExceptionHandler {

    /**
     * Use traits.
     */
    use \Sidex\Traits\ConfigureClassesTrait;

    /**
     * A user-defined error handler clousure.
     *
     * @var Closure Object
     */
    protected $handler;

    /**
     * Class constructor.
     *
     * @param  array  $config
     */
    public function __construct(array $config = array())
    {
        $this->configureClass($this, $config);

        // set the global application error handler:
        $this->setErrorHandler();

        // set the exception error handler for logging errors and shutdown
        // the application:
        $this->setExceptionHandler($this->handler);
    }

    /**
     * Define a global application error handler.
     *
     * @access public
     */
    public function setErrorHandler()
    {
        set_error_handler([$this, 'handleErrors']);
    }

    /**
     * Define a global application exception handler.
     *
     * @access public
     * @param  mixed
     */
    public function setExceptionHandler($clousure)
    {
        if (is_null($clousure) === false) {
            set_exception_handler($clousure);
        } else {
            set_exception_handler([$this, 'handleExceptions']);
        }
    }

    /**
     * The application-defined error handler method.
     *
     * @access public
     * @param  integer  $errno
     * @param  string   $message
     * @param  string   $file
     * @param  integer  $line
     * @param  array    $context
     * @return void
     *
     * @throws new ErrorException
     */
    public function handleErrors($errno, $message, $file, $line, array $context)
    {
        // error was suppressed with the @-operator:
        if (error_reporting() === 0) {
            return;
        }

        throw new ErrorException($message, 0, $errno, $file, $line);
    }

    /**
     * The application-defined exception handler method.
     *
     * @access public
     * @param  Exception Object  $e
     * @return void
     */
    public function handleExceptions($e)
    {
        debug($e);exit;
    }

    // end class...
}

/* End of file ErrorExceptionHandler.php */
/* Location: ./(<application folder>/libraries/<namespace>)/ErrorExceptionHandler.php */
