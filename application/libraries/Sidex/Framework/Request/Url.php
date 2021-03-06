<?php namespace Sidex\Framework\Request;

use Sidex\Framework\Input\Input;

class Url implements UrlInterface {


    /**
     * Sidex\Framework\Input\Input Object
     *
     * @access protected
     */
    protected $server;


    /**
     * Pattern for friendly URL's.
     *
     * @var string
     */
    protected $regexp = '/[^a-zA-Z0-9_.]/';


    /**
     * The constructor
     *
     * @access public
     */
    public function __construct()
    {
        $this->input = new Input('server');
    }


    /**
     * Returns the URI which was given in order to access to any page from
     * the application.
     *
     * @return string (the requested URI)
     */
    public function requestUri()
    {
        $requestUri = $this->input->get('REQUEST_URI');
        $scriptName = $this->input->get('SCRIPT_NAME');
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
                $requestUri = $this->input->get('PATH_INFO');
        }

        return $this->parseUrl($requestUri);
    }


    /**
     * Parse a correct functionally URL for the application.
     *
     * @access protected
     * @param  string $url (the URL to parse)
     * @return string
     */
    protected function parseUrl($url = '/')
    {
        $parsedUrl = parse_url($url, PHP_URL_PATH);
        return preg_replace($this->regexp, '/', trim($parsedUrl, '/'));
    }


    // end class.
}

/* End of file Url.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Url.php */
