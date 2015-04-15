<?php namespace Sidex\Framework\Input;

interface InputInterface {

    /**
     * Checks if the specified index exists.
     *
     * @access public
     * @param  string  $index (the name of the index)
     * @return mixed
     */
    public function get($index = '');

    // end interface...
}

/* End of file InputInterface.php */
/* Location: ./(<application folder>/libraries/<namespace>)/InputInterface.php */
