<?php namespace Sidex\Database\ORM;

use \Sidex\Database\PDO\QueryBuilder;

class Model extends QueryBuilder {


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
        parent::__construct();
    }


    // end class...
}

/* End of file Model.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Model.php */

