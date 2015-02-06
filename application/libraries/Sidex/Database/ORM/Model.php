<?php namespace Sidex\Database\ORM;

use ReflectionClass;
use \Sidex\Database\PDO\Connection;
use \Sidex\Database\ORM\ModelConfigurator;
use \Sidex\Database\ORM\Interfaces\DataSource;
use \Sidex\Database\ORM\Interfaces\Modifiable;
use \Sidex\Database\ORM\Interfaces\Transactional;

class Model implements DataSource, Modifiable, Transactional {

    const MODEL_PREFIX = 'Model';

    /**
     * Saves the default model class prefix.
     *
     * @var public
     */
    public $modelPrefix = self::MODEL_PREFIX;

    /**
     * Saves the row that is the primary key in the table.
     *
     * @var string
     */
    public $primary = 'id';

    /**
     * The database table used by the model.
     *
     * @var string | null by default.
     */
    public $table = null;

    /**
     * A simple PDO connection instance.
     *
     * @var PDO Object
     */
    public $db;

    /**
     * Saves a select statements.
     *
     * @var string
     */
    private $select = '*';

    /**
     * Class constructor.
     *
     * @access public
     */
    public function __construct()
    {
        $pdo = new Connection;
        $pdo->run();
        $this->db = $pdo->pdo;

        $this->setTableName();
    }

    /**
     * This method is triggered when invoking inaccessible methods in
     * an object context.
     *
     * @access public
     */
    public function __call($name, $arguments)
    {
        debug($name, $arguments);exit;
    }

    /**
     * Make a select statement.
     *
     * @access public
     * @param  string $select (default *) | mixed
     * @return Model Object
     */
    public function select($select = '*')
    {
        if (func_num_args() > 1) {
            $select = func_get_args();
        }

        if (!is_string($select)) {
            $select = join(', ', $select);
        }

        $this->select = $select;
        return $this;
    }

    /**
     * Sets the table name from a model class name.
     *
     * @access private
     */
    private function setTableName()
    {
        if (isset($this->table) === true) {
            return;
        }

        if ($className = $this->getShortModelClassName()) {
            $this->table = strtolower($className);
        }
    }

    /**
     * Get the name from the child class.
     *
     * @access private
     * @return string  (the class name without namespace.)
     */
    private function getShortModelClassName()
    {
        $classInfo = new ReflectionClass($this);
        $className = $classInfo->getShortName();
        $className = str_replace($this->modelPrefix, '', $className);
        return $className;
    }

    // end class...
}

/* End of file Model.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Model.php */

