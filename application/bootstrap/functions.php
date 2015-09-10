<?php if ( ! defined('APPATH')) exit('No direct script access allowed.');

/*
 *-----------------------------------------------------------------------------
 * ADDITIONAL PHP FUNCTIONS
 *-----------------------------------------------------------------------------
 *
 * The additional php functions for your application.
 *
 */


// ----------------------------------------------------------------------------
// PATHS:
// ----------------------------------------------------------------------------


if (! function_exists('normalize_path')) {

    /**
     * Builds a file path with the appropriate directory separator.
     *
     * @param  string
     * @return string path
     */
    function normalize_path($path = '')
    {
        if (func_num_args() > 1) {
            $path = implode('/', func_get_args());
        }

        $path = preg_replace('/\/+/', '/', str_replace('\\', '/', $path));
        return $path;
    }
}


if (! function_exists('application_path')) {

    /**
     * Alias to appath()
     *
     * @param  string
     * @return string path
     */
    function application_path($path = '')
    {
        return appath($path);
    }
}


if (! function_exists('appath')) {

    /**
     * Returns the path within APPATH that was generated in the file
     * index.php (front controller) with the appropriate directory separator.
     *
     * @param  string
     * @return string path
     */
    function appath($path = '')
    {
        return normalize_path(APPATH, $path);
    }
}


if (! function_exists('fcpath')) {

    /**
     * Returns the path within FCPATH that was generated in the file
     * index.php (front controller) with the appropriate directory separator.
     *
     * @access public
     * @param  string $path (default empty string.)
     * @return string path
     */
    function fcpath($path = '')
    {
        return normalize_path(FCPATH, $path);
    }
}


if (! function_exists('asset')) {

    /**
     * Generate a URL to an application asset.
     *
     * @param  mixed
     * @return URL to an asset
     */
    function asset()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $fcBasename = pathinfo(FCPATH, PATHINFO_BASENAME);
        $path2asset = substr($requestUri, 0, strrpos($requestUri, $fcBasename));
        $uri = implode('/', func_get_args());
        $uri = implode('/', [$path2asset, $fcBasename, $uri]);
        return normalize_path($uri);
    }
}


if (! function_exists('redirect')) {

    /**
     * Send a raw HTTP header redirect.
     *
     * @param string   $uri
     * @param bollean  $code = 302:Found, 301:Moved Permanently
     */
    function redirect($uri = '/', $code = 302)
    {
        header("Location:" .$url, true, $code);
        exit;
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
     * @param  mixed
     * @return void
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
     * @param  mixed
     * @return void
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


/* End of file functions.php */
/* Location: ./(<application folder>/)bootstrap/functions.php */
