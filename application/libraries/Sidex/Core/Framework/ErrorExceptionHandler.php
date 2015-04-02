<?php namespace Sidex\Core\Framework;

use ErrorException;

class ErrorExceptionHandler {

    /**
     * Save the exception handler that will be used by the application.
     *
     * @var mixed
     */
    private $handler;

    /**
     * Configure the error and exception handler and initialize it.
     *
     * @return void
     */
    public function initialize($handler)
    {
        $this->handler($handler);
        $this->setErrorHandler();
        $this->setFatalHandler();

        // set the exception error handler, useful for logging errors and/or
        // shutdown the application:
        set_exception_handler($this->handler);
    }

    /**
     * Establishes a general error handler.
     *
     * @access protected
     * @return void
     */
    protected function setErrorHandler()
    {
        set_error_handler([$this, 'errorHandler']);
    }

    /**
     * Establishes a fatal error handler.
     *
     * @access protected
     * @return void
     */
    protected function setFatalHandler()
    {
        register_shutdown_function([$this, 'fatalHandler'], $this->handler);
    }

    /**
     * The application-defined error handler method.
     *
     * @param  integer  $errno
     * @param  string   $message
     * @param  string   $file
     * @param  integer  $line
     * @param  array    $context
     * @return void
     *
     * @throws new ErrorException
     */
    public function errorHandler($errno, $message, $file, $line, array $context = array())
    {
        // error was suppressed with the @-operator:
        if (error_reporting() === 0) {
            return;
        }

        throw new ErrorException($message, 0, $errno, $file, $line);
    }

    /**
     * The application-defined fatal error handler method.
     *
     * @return void
     */
    public function fatalHandler()
    {
        if ($error = error_get_last()) {
            //   ob_clean();
            extract($error);
            $exception = new ErrorException($message, $type, 0, $file, $line);
            call_user_func($this->handler, $exception);
        }
    }

    /**
     * Get/Set the exception handler that will be used by the application.
     *
     * @access protected
     * @param  mixed  $handler (a valid clousure or callback)
     * @return mixed
     */
    protected function handler($handler = null)
    {
        if (is_null($handler) === true) {
            return $this->handler;
        } else {
            return $this->handler = $handler;
        }
    }

    // end class...
}

/* End of file ErrorExceptionHandler.php */
/* Location: ./(<application folder>/libraries/<namespace>)/ErrorExceptionHandler.php */
