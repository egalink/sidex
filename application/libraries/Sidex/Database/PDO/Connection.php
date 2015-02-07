<?php namespace Sidex\Database\PDO;

use Exception;
use InvalidArgumentException;
use Sidex\Database\PDO\ConnectionInterface;
use Sidex\Database\PDO\Connectors\MySqlConnector;

class Connection implements ConnectionInterface {


    /**
     * The active PDO connection.
     *
     * @var PDO Object
     */
    public $pdo;


    /**
     * Saves the table name which the query is targeting.
     *
     * @var string
     */
    public $table = null;


    /**
     * Performed query Query statement.
     *
     * @var string
     */
    private $query = '';


    /**
     * Array of where clauses for the query.
     *
     * @var array
     */
    private $where = array();


    /**
     * Array of blindings.
     *
     * @var array
     */
    private $binds = array();


    /**
     * Array of joins clauses for the query.
     *
     * @var array
     */
    private $joins = array();


    /**
     * Array of "order by" clause for the query.
     *
     * @var array
     */
    private $order = array();


    /**
     * Establish a database connection.
     *
     * @throws Exception
     */
    public function run()
    {
        $config = require $this->buildpath(APPATH . 'config/database.php');

        if (empty($config) === true) {
            throw new Exception ("You may specify a database connection.");
        }

        $this->pdo = $this->connect2database($config);
    }


    /**
     * Create a select statement for the database.
     *
     * @param  string | mixed.
     * @return Object
     */
    public function select($query = '*')
    {
        if (func_num_args() > 1) {
            $query = func_get_args();
        }

        if (! is_string($query)) {
            $query = join(', ', $query);
        }

        $this->query .= "SELECT {$query} ";
        return $this;
    }


    /**
     * Set the table which the query is targeting.
     *
     * @param  string
     * @return Object
     */
    public function table($table = null)
    {
        if (is_string($table) === true) {
            $this->table = $table;
        }

        return $this;
    }


    /**
     * Add a basic where clause to the query.
     *
     * @param string  $column
     * @param string  $operator
     * @param mixed   $value
     * @param mixed   $value
     * @param string  $boolean
     * @param mixed
     * @return Object
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        if (! is_null($value)) {

            $clause = (count($this->where) > 0) ? $boolean : 'where';
            $clause.= " {$column} {$operator} ?";
            $this->where[] = $clause;
            $this->binds[]['?'] = $value;
        }

        return $this;
    }


    /**
     * Add a join clause to the query.
     *
     * @param string  $table
     * @param string  $one
     * @param string  $operator
     * @param string  $two
     * @param string  $type
     * @return Object
     */
    public function join($table, $one, $operator = null, $two = null, $type = 'inner')
    {
        $this->joins[] = "{$type} join {$table} on {$one} {$operator} {$two}";
        return $this;
    }


    /**
     * Add a inner join clause to the query.
     *
     * @param string  $table
     * @param string  $one
     * @param string  $operator
     * @param string  $two
     * @return Object
     */
    public function ijoin($table, $one, $operator = null, $two = null)
    {
        return $this->join($table, $one, $operator, $two, 'inner');
    }


    /**
     * Add a left join clause to the query.
     *
     * @param string  $table
     * @param string  $one
     * @param string  $operator
     * @param string  $two
     * @return Object
     */
    public function ljoin($table, $one, $operator = null, $two = null)
    {
        return $this->join($table, $one, $operator, $two, 'left');
    }


    /**
     * Add a right join clause to the query.
     *
     * @param string  $table
     * @param string  $one
     * @param string  $operator
     * @param string  $two
     * @return Object
     */
    public function rjoin($table, $one, $operator = null, $two = null)
    {
        return $this->join($table, $one, $operator, $two, 'right');
    }


    /**
     * Add an "order by" clause to the query.
     *
     * @param  string $column
     * @param  string $direction
     * @return Object
     */
    public function order($column, $direction = 'asc')
    {
        $this->order[] = "{$column} {$direction}";
        return $this;
    }


    /**
     * Establish a PDO connection based on the configuration.
     *
     * @access private
     * @param  array
     * @return PDO Object
     *
     * @throws InvalidArgumentException
     */
    private function connect2database(array $config)
    {
        if (empty ($config['driver']) === true) {
            throw new InvalidArgumentException("A driver must be specified.");
        }

        $pdo = $this->createConnection($config['driver'])->connect($config);
        return $pdo;
    }


    /**
     * Create a connector instance based on the driver name.
     *
     * @access private
     * @param  string
     * @return PDO Object
     *
     * @throws InvalidArgumentException
     */
    private function createConnection($driver = 'mysql')
    {
        switch ($driver) {

            case 'mysql':
                return new MySqlConnector;

            case 'pgsql':
                //return new PostgresConnector;

            case 'sqlite':
                //return new SQLiteConnector;

            case 'sqlsrv':
                //return new SqlServerConnector;

        }

        throw new InvalidArgumentException("Unsupported driver [{$driver}]");
    }


    /**
     * Builds a file path with the appropriate directory separator.
     *
     * @access private
     * @param  string
     * @return string path
     */
    private function buildpath($path = '')
    {
        return build_path($path);
    }


    // end class...
}

/* End of file Connection.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Connection.php */
