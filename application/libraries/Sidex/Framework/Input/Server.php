<?php namespace Sidex\Framework\Input;

class Server implements InputInterface {


    /**
     * Retrieve an input item from the server.
     *
     * @access public
     * @param  string  $key
     * @return mixed
     */
    public function get($key = null)
    {
        return filter_input(INPUT_SERVER, $key, self::FILTER_SANITIZE);
    }


    /**
     * Determine if the request contains a non-empty value for an input
     * item.
     *
     * @access public
     * @param  string  $key
     * @return bool
     */
    public function has($key = null) {}


    /**
     * Get a subset of the items from the input data.
     *
     * @access public
     * @param  array  $keys
     * @return array
     */
    public function only($keys = array()) {}


    // end class.
}

/* End of file Server.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Server.php */
