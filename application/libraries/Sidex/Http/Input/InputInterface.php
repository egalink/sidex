<?php namespace Sidex\Http\Input;

interface InputInterface {

    public function __construct(array $options = array());
    public function get($index = '');

    // end class...
}

/* End of file InputInterface.php */
/* Location: ./(<application folder>/libraries/<namespace>)/InputInterface.php */
