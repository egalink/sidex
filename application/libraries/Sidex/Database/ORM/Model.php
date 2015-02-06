<?php namespace Sidex\Database\ORM;

use \Sidex\Database\PDO\Connection;
use \Sidex\Database\ORM\Interfaces\DataSource;
use \Sidex\Database\ORM\Interfaces\Modifiable;
use \Sidex\Database\ORM\Interfaces\Transactional;

class Model implements DataSource, Modifiable, Transactional {

    /**
     * A simple PDO connection instance.
     *
     * @var PDO Object
     */
    protected $db;

    /**
     * Class constructor.
     *
     * @access protected
     */
    protected function __construct()
    {
        $pdo = new Connection;
        $pdo->run();
        $this->db = $pdo->pdo;
    }

    // end class...
}

/* End of file Model.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Model.php */

