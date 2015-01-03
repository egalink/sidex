<?php  if ( ! defined('APPPATH')) exit('No direct script access allowed.');

/**
 * ----------------------------------------------------------------------------
 * ADDITIONAL FUNCTIONS FOR SIDEX
 * ----------------------------------------------------------------------------
 *
 * The additional functions for your application.
 *
 */

if (! function_exists('application_path')) {

    /**
     * Returns the path within APPPATH that was generated in the file
     * index.php (front controller).
     *
     * @access public
     * @param  string
     * @return string
     */
    function application_path($path = '')
    {
        return buildpath(APPPATH . $path);
    }
}


if (! function_exists('debug')) {

    /**
     * Displays information about a variable in a way that's readable by humans.
     *
     * @access public
     * @param  mixed
     */
    function debug()
    {
        $trace = debug_backtrace();
        echo '<pre style="font-family:monospace;font-size:11px;">Archivo: ';
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
     */
    function vdump()
    {
        $trace = debug_backtrace();
        echo '<pre style="font-family:monospace;font-size:11px;">Archivo: ';
        echo $trace[0]['file'].' - '.$trace[0]['line'];
        echo '</pre>';

        foreach(func_get_args() as $variable) {
            echo '<pre style="font-family:monospace;font-size:11px;">';
            echo var_dump($variable);
            echo '</pre>';
        }
    }
}


if (! function_exists('buildpath')) {

    /**
     * Generates a file path with DIRECTORY_SEPARATOR.
     *
     * @access public
     * @param  string
     * @return string
     */
    function buildpath($path = '')
    {
        $path = str_replace('\\','/', $path);
        $path = preg_replace('/\/+/', DIRECTORY_SEPARATOR, $path);
        return $path;
    }
}


if (! function_exists('request_uri')) {

    /**
     * Retrieves a uniform resource identifier or URI (including segments) of
     * an request made to the server.
     *
     * @access public
     * @return string
     */
    function request_uri()
    {
        $url = new \Sidex\Http\Request\Url;
        return $url->requestUri();
    }
}


if (! function_exists('site_url')) {

    /**
     * Generates a Uniform Resource Locator or URL with additional parameters to
     * make a request to the server.
     *
     * @access public
     * @param  string
     * @return string
     */
    function site_url($uri = '')
    {
        $url = new \Sidex\Http\Request\Url;
        return $url->performUrl($uri);
    }
}


if (! function_exists('base_url')) {

	/**
	 * Generates a Uniform Resource Locator or URL.
	 *
	 * @access public
	 * @return string
	 */
	function base_url($uri = '')
	{
		$url = new \Sidex\Http\Request\Url;
		return $url->baseUrl($uri);
	}
}


/* End of file functions.php */
/* Location: ./(<application folder>/)bootstrap/functions.php */
