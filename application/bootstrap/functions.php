<?php  if ( ! defined('APPATH')) exit('No direct script access allowed.');

/**
 * ----------------------------------------------------------------------------
 * ADDITIONAL PHP FUNCTIONS FOR SIDEX
 * ----------------------------------------------------------------------------
 *
 * The additional functions for your application.
 *
 */


// ----------------------------------------------------------------------------
// PATHS:
// ----------------------------------------------------------------------------


if (! function_exists('build_path')) {

    /**
     * Makes a correct formatted file path with DIRECTORY_SEPARATOR.
     *
     * @access public
     * @param  string $path (default empty string.)
     * @return string path
     */
    function build_path($path = '')
    {
        if (func_num_args() > 1) {
            $path = join('/', func_get_args());
        }

        $path = str_replace('\\','/', $path);
        $path = preg_replace('/\/+/', DIRECTORY_SEPARATOR, $path);
        return $path;
    }
}


if (! function_exists('application_path')) {

    /**
     * Returns the path within APPATH that was generated in the file
     * index.php (front controller) with the appropriate directory separator.
     *
     * @access public
     * @param  string $path (default empty string.)
     * @return string path
     */
    function application_path($path = '')
    {
        return build_path(APPATH, $path);
    }
}


// ----------------------------------------------------------------------------
// DEBUGGING:
// ----------------------------------------------------------------------------


if (! function_exists('debug')) {

    /**
     * Displays information about a variable in a way that's readable by
     * humans.
     *
     * @access public
     * @param  mixed
     * @return html
     */
    function debug()
    {
        $trace = debug_backtrace();
        echo '<pre style="font-family:monospace;font-size:11px;">File: ';
        echo $trace[0]['file'].' - '.$trace[0]['line'];
        echo '</pre>';

        foreach(func_get_args() as $variable) {
            echo '<pre style="font-family:monospace;font-size:11px;">';
            print_r($variable);
            echo '</pre>';
        }
    }
}


if (! function_exists('vdump')) {

    /**
     * This function displays structured information about one or more
     * expressions that includes its type and value.
     *
     * @access public
     * @param  mixed
     * @return html
     */
    function vdump()
    {
        $trace = debug_backtrace();
        echo '<pre style="font-family:monospace;font-size:11px;">File: ';
        echo $trace[0]['file'].' - '.$trace[0]['line'];
        echo '</pre>';

        foreach(func_get_args() as $variable) {
            echo '<pre style="font-family:monospace;font-size:11px;">';
            echo var_dump($variable);
            echo '</pre>';
        }
    }
}


// ----------------------------------------------------------------------------
// URL's
// ----------------------------------------------------------------------------


if (! function_exists('request_uri')) {

    /**
     * Returns the URI which was given in order to access to any page from
     * the application.
     *
     * @access public
     * @return string (the requested URI.)
     */
    function request_uri()
    {
        $url = new \Sidex\Http\Request\Url;
        return $url->requestUri();
    }
}


if (! function_exists('site_url')) {

    /**
     * Generate a absolute URL to the given path.
     *
     * @access public
     * @param  string  $uri (default empty.)
     * @return URL
     */
    function site_url($uri = '')
    {
        $url = new \Sidex\Http\Request\Url;
        return $url->siteUrl($uri);
    }
}


if (! function_exists('base_url')) {

    /**
     * Generate a URL to an application asset.
     *
     * @access public
     * @param  string  $uri (default empty.)
     * @return URL to an asset
     */
    function base_url($uri = '')
    {
        $url = new \Sidex\Http\Request\Url;
        return $url->baseUrl($uri);
    }
}


/* End of file functions.php */
/* Location: ./(<application folder>/)bootstrap/functions.php */

