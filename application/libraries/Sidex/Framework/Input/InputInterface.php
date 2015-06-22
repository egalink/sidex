<?php namespace Sidex\Framework\Input;

interface InputInterface {


    /**
     * HTML-escape '"<>& and characters with ASCII value less than 32,
     * optionally strip or encode other special characters.
     *
     * @var mixed
     */
    const FILTER_SANITIZE = FILTER_SANITIZE_SPECIAL_CHARS;


    /**
     * Retrieve an input item from the request.
     *
     * @access public
     * @param  string  $key
     * @return mixed
     */
    public function get($key = '');


    /**
     * Determine if the request contains a non-empty value for an input
     * item.
     *
     * @access public
     * @param  string  $key
     * @return bool
     */
    public function has($key = null);


    /**
     * Get a subset of the items from the input data.
     *
     * @access public
     * @param  array  $keys
     * @return array
     */
    public function only($keys = array());


    // end interface.
}

/* End of file InputInterface.php */
/* Location: ./(<application folder>/libraries/<namespace>)/InputInterface.php */
