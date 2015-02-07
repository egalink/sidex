<?php namespace Sidex\Database\ORM;

use \Sidex\Database\PDO\Connection;

class Model extends Connection {


    /**
     * Saves the table name associated with the model.
     *
     * @var string
     */
    public $table = null;


    /**
     * Class constructor.
     *
     * @access public
     */
    public function __construct()
    {
        $this->run();
    }


    // end class...
}

/* End of file Model.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Model.php */

