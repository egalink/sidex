<?php namespace Sidex\Http\Request;

use \Sidex\Http\Request\UrlInterface as UrlInterface;
use \Sidex\Http\Input\Server as Server;

class Url implements UrlInterface {


    const FRONT_CONTROLLER_NAME = FCNAME;

    /**
     * Sidex\Http\Input\Server Object
     *
     * @access private
     */
    private $server;

    /**
     * Pattern for friendly URL's.
     *
     * @var string
     */
    private $regexp = '/[^a-zA-Z0-9_.]/';

    /**
     * Url class constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->server = new Server;
    }

    /**
     * Parse a correct functionally URL for the application.
     *
     * @param  string $url (The URL to parse.)
     * @return string
     */
    public function parseUrl($url = '/')
    {
        $parsedUrl = parse_url($url, PHP_URL_PATH);
        return preg_replace($this->regexp, '/', trim($parsedUrl, '/'));
    }

    /**
     * Returns the URI which was given in order to access to any page from
     * the application.
     *
     * @return string (the requested URI.)
     */
    public function requestUri()
    {
        $requestUri = $this->server->get('REQUEST_URI');
        $scriptName = $this->server->get('SCRIPT_NAME');
        $scriptPath = dirname($scriptName);

        switch ($requestUri) {

            case (strpos($requestUri, $scriptName) === 0):
                // remove the script name in the request uri:
                $requestUri = substr($requestUri, strlen($scriptName));
                break;

            case (strpos($requestUri, $scriptPath) === 0):
                // remove the path of the script that receives the request:
                $requestUri = substr($requestUri, strlen($scriptPath));
                break;

            default:
                $requestUri = $this->server->get('PATH_INFO');
        }

        return $this->parseUrl($requestUri);
    }

    /**
     * Generate a absolute URL.
     *
     * @return URL
     */
    public function performUrl()
    {
        $url = $this->parseUrl($this->server->get('REQUEST_URI'));

        if ($requestUri = $this->requestUri()) {
            $url = str_replace($requestUri, '', $url);
            $url = rtrim($url, '/');
        }

        return sprintf('/%s', $url);
    }

    /**
     * Generate a absolute URL to the given path.
     *
     * @param  string  $uri (default empty.)
     * @return URL
     */
    public function siteUrl($uri = '')
    {
        $url = $this->performUrl($uri);

        if ($uri != '') {
            $url = sprintf('%s/%s', $url, $this->parseUrl($uri));
        }

        return $url;
    }

    /**
     * Generate a URL to an application asset.
     *
     * @param  string  $uri (default empty.)
     * @return URL to an asset
     */
    public function baseUrl($uri = '')
    {
        $replace = self::FRONT_CONTROLLER_NAME;
        $baseUrl = str_replace($replace, '', $this->performUrl());
        return sprintf('%s/%s', rtrim($baseUrl, '/'), trim($uri, '/'));
    }

    // end class...
}

/* End of file Url.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Url.php */
