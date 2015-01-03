<?php namespace Sidex\Http\Request;

use \Sidex\Http\Request\UrlInterface as UrlInterface;

class Url implements UrlInterface {


    const FRONT_CONTROLLER_NAME = FCNAME;


    public function parseUrl($url = '/')
    {
        $purl = trim(parse_url($url, PHP_URL_PATH), '/');
        return preg_replace('/[^a-zA-Z0-9.]/', '/', $purl);
    }


    public function requestUri()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $scriptPath = dirname($scriptName);

        if (strpos($requestUri, $scriptName) === 0) {
            // remove the script name in the request uri:
            $requestUri = substr($requestUri, strlen($scriptName));
        }
        elseif (strpos($requestUri, $scriptPath) === 0) {
            // remove the path of the script that receives the request:
            $requestUri = substr($requestUri, strlen($scriptPath));
        }

        return $this->parseUrl($requestUri);
    }


    public function performUrl($uri = '')
    {
        $url = $this->parseUrl($_SERVER['REQUEST_URI']);

        if ($requestUri = $this->requestUri()) {
            $url = str_replace($requestUri, '', $url);
            $url = rtrim($url, '/');
        }

        if ($uri != '') {
            $url = $this->parseUrl($url . '/' . $uri);
        }

        return '/' . $url;
    }


    public function baseUrl($uri = '')
    {
        $baseUrl = $this->performUrl();
        $urlPath = str_replace(self::FRONT_CONTROLLER_NAME, '', $baseUrl);
        return rtrim($urlPath, '/') . '/' . $uri;
    }


    // end class...
}

/* End of file Url.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Url.php */
