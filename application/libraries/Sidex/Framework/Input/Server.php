<?php namespace Sidex\Framework\Input;

class Server implements InputInterface {

    /**
     * Checks if the specified index exists.
     *
     * @access public
     * @param  string  $index (the name of the index)
     * @return mixed
     */
    public function get($index = '')
    {
        return filter_has_var(INPUT_SERVER, $index) ? $_SERVER[$index] : null;
    }

    // end class...
}

/* End of file Server.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Server.php */
