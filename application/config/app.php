<?php if ( ! defined('APPATH')) exit('No direct script access allowed.');

return array(

    /*
     * ------------------------------------------------------------------------
     * APPLICATION DEBUG MODE
     * ------------------------------------------------------------------------
     *
     * When your application is in debug mode, detailed error messages will be
     * shown on every error. If disabled, a simple generic error page is shown.
     *
     */

    'debug' => true,

    /**
     * ------------------------------------------------------------------------
     * DEFAULT CONTROLLER CLASS NAME
     * ------------------------------------------------------------------------
     *
     * This indicates which controller class should be loaded if the URI
     * contains no data.
     *
     */

    'controller' => 'BaseController',

    /**
     * ------------------------------------------------------------------------
     * DEFAULT CONTROLLER ACTION NAME
     * ------------------------------------------------------------------------
     *
     * This will tell the Router what URI segments should be used if those
     * provided in the URL cannot be matched to a valid route.
     *
     */

    'action' => 'index',

    /*
     * ------------------------------------------------------------------------
     * SESSION CONFIGURATION
     * ------------------------------------------------------------------------
     *
     * The Session class stores session information for each user as
     * serialized (and optionally encrypted) data in a cookie.
     *
     * expire - The number of SECONDS you want the session to last.
     * cookie - The name of the session cookie name.
     *
     */

    'session' => array(

        'expire' => 7200,
        'cookie' => 'sidex',

    ),

    /*
     * ------------------------------------------------------------------------
     * USER-DEFINED ERROR HANDLER
     * ------------------------------------------------------------------------
     *
     * You can define a custom error handler, useful for custom error messages
     * or logging.
     *
     * The custom error handler must be a valid clousure or callback.
     *
     */

    'handler' => null,

);

/* End of file app.php */
/* Location: ./(<application folder>/)config/app.php */
