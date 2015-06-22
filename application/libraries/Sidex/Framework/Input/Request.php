<?php namespace Sidex\Framework\Input;

class Request implements InputInterface {


    /**
     * Retrieve an input item from the request.
     *
     * @access public
     * @param  string  $key
     * @return mixed
     */
    public function get($key = null)
    {
        return isset($_REQUEST[$key]) ? filter_var($_REQUEST[$key], self::FILTER_SANITIZE) : null;
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
    public function only($keys = array())
    {
        $data = array();

        foreach ($keys as $key) {
            $data[$key] = $this->get($key);
        }

        return $data;
    }


    // end class.
}

/* End of file Request.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Request.php */
