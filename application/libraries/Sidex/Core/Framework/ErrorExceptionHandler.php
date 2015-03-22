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
        // set the global application error handler:
        $this->setErrorHandler();

        // set the exception error handler, useful for logging errors and/or
        // shutdown the application:
        $this->setExceptionHandler($handler);
    }

    /**
     * Define a global application error handler.
     *
     * @access public
     */
    protected function setErrorHandler()
    {
        set_error_handler([$this, 'handleErrors']);
    }

    /**
     * Define a global application exception handler.
     *
     * @access public
     * @param  mixed  $handler (a valid clousure or callback.)
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
    public function handleErrors($errno, $message, $file, $line, array $context)
    {
        // error was suppressed with the @-operator:
        if (error_reporting() === 0) {
            return;
        }

        throw new ErrorException($message, 0, $errno, $file, $line);
    }

    // end class...
}

/* End of file ErrorExceptionHandler.php */
/* Location: ./(<application folder>/libraries/<namespace>)/ErrorExceptionHandler.php */
