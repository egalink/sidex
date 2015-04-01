<?php namespace Sidex\Core\Framework;

use ErrorException;

class ErrorExceptionHandler {

    /**
     * Configure the error and exception handler and initialize it.
     *
     * @access public
     * @param  mixed  $handler
     */
    public function run($handler)
    {
        // establishes the general and fatal error handler for the application:
        $this->setErrorHandler();
        $this->setFatalHandler($handler);

        // set the exception error handler, useful for logging errors and/or
        // shutdown the application:
        $this->setExceptionHandler($handler);
    }

    /**
     * Establishes a general error handler for the application.
     *
     * @access public
     */
    protected function setErrorHandler()
    {
        set_error_handler([$this, 'errorHandler']);
    }

    /**
     * Establishes a fatal error handler for the application.
     *
     * @access public
     * @param  mixed  $handler (a valid clousure or callback)
     */
    public function setFatalHandler($handler)
    {
        register_shutdown_function([$this, 'fatalHandler'], $handler);
    }

    /**
     * Define a global application exception handler.
     *
     * @access public
     * @param  mixed  $handler (a valid clousure or callback)
     */
    public function setExceptionHandler($handler)
    {
        set_exception_handler($handler);
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
     * @access public
     * @param  mixed  $handler (a valid clousure or callback)
     * @return void
     */
    public function fatalHandler($handler)
    {
        if ($error = error_get_last()) {
            ob_clean();
            extract($error);
            $exception = new ErrorException($message, $type, 0, $file, $line);
            call_user_func($handler, $exception);
        }
    }

    // end class...
}

/* End of file ErrorExceptionHandler.php */
/* Location: ./(<application folder>/libraries/<namespace>)/ErrorExceptionHandler.php */
