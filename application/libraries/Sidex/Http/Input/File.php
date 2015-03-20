<?php namespace Sidex\Http\Input;

use SplFileInfo;

class File {

    /**
     * constructor de la clase.
     *
     * @access public
     * @param  string  $key
     * @return array
     */
    public function get($key = '')
    {
        return isset($_FILES[$key]) ? $_FILES[$key] : array();
    }

    // end class...
}

/* End of file File.php */
/* Location: ./(<application folder>/libraries/<namespace>)/File.php */
