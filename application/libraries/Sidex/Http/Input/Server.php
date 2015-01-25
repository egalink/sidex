<?php namespace Sidex\Http\Input;

use Sidex\Http\Input\InputInterface as InputInterface;

class Server implements InputInterface {

    /**
     * Server class constructor.
     *
     * @return void
     */
    public function __construct(array $options = array())
    {
        //
    }

    /**
     * Checks if the specified index exists in $_SERVER. If exists, returns
     * his value.
     *
     * @access public
     * @param  string $index (the name of the index).
     * @return mixed | null if the given value not exists
     */
    public function get($index = '')
    {
        return filter_has_var(INPUT_SERVER, $index)? $_SERVER[$index] : null;
    }

    // end class...
}

/* End of file Server.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Server.php */
