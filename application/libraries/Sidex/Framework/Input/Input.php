<?php namespace Sidex\Framework\Input;

class Input implements InputInterface {


    /**
     * The input method used by the input class.
     *
     * @var mixed Object
     */
    protected $method;


    /**
     * Constructor.
     *
     * @access public
     * @param  string  $method (default value is 'request')
     */
    public function __construct($method = 'request')
    {
        $this->from($method);
    }


    /**
     * Specifies wich input method is used by the input class to
     * retrieve http arguments.
     *
     * @access public
     * @param  string  $method
     * @return void
     */
    public function from($method = '')
    {
        switch($method) {

            case 'server':
                $this->method = new Server;
                break;

            case 'files':
                $this->method = new Files;
                break;

            case 'cookie':
                $this->method = new Cookie;
                break;

            case 'get': case 'post': case 'request': default:
                $this->method = new Request;
                break;
        }
    }


    /**
     * Retrieve an input item from the request.
     *
     * @access public
     * @param  string  $key
     * @return mixed
     */
    public function get($key = null)
    {
        return $this->method->get($key);
    }


    /**
     * Determine if the request contains a non-empty value for an input
     * item.
     *
     * @access public
     * @param  string  $key
     * @return bool
     */
    public function has($key = null)
    {
        return !is_null($this->method->get($key));
    }


    /**
     * Get a subset of the items from the input data.
     *
     * @access public
     * @param  array  $keys
     * @return array
     */
    public function only($keys = array())
    {
        return $this->method->only($keys);
    }


    // end class.
}

/* End of file Input.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Input.php */
