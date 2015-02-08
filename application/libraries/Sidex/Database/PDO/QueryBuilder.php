<?php namespace Sidex\Database\PDO;

use Sidex\Database\PDO\Connection;
use Sidex\Database\PDO\QueryBuilderInterface;

class QueryBuilder implements QueryBuilderInterface {


    /**
     * The active database connection with PDO.
     *
     * @var PDO Object
     */
    public $db;


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
     * Array of where clauses for the query.
     *
     * @var array
     */
    private $where = array();


    /**
     * Array of "order by" clause for the query.
     *
     * @var array
     */
    private $order = array();


    /**
     * Establish a database connection.
     *
     * @access public
     */
    public function __construct()
    {
        $connection = new Connection;
        $connection->run();
        $this->db = $connection->pdo;
    }


    /**
     * Create a select statement for the database.
     *
     * @param  string | mixed.
     * @return Object
     */
    public function select($query = '*')
    {
        $this->query = "SELECT ";

        if (func_num_args() > 1) {
            $query = func_get_args();
        }

        if (! is_string($query)) {
            $query = join(', ', $query);
        }

        $this->query.= trim($query);

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
        if (func_num_args() > 1) {
            $table = func_get_args();
        }

        if (! is_string($table)) {
            $table = join(', ', $table);
        }

        $this->table = trim($table);

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
            $boolean = ! empty($boolean) ? strtoupper($boolean) : 'AND';
            $this->where[] = trim("{$boolean} {$column} {$operator} ?");
            $this->binds[] = $value;
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
        $type = ! empty($type) ? strtoupper($type) : 'INNER';
        $join = trim("{$type} JOIN {$table} ON {$one} {$operator} {$two}");
        $this->joins[] = $join;
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
        $direction = strtoupper($direction);
        $this->order[] = trim("{$column} {$direction}");
        return $this;
    }


    /**
     * Execute the query as a "select" statement.
     *
     * @return array | boolean false
     */
    public function all()
    {
        $query = $this->buildQuery('select');

        if (is_string($query) === false) {
            return false;
        }

        $sth = $this->db->prepare($query);
        return $sth->execute($this->binds) ? $sth->fetchAll() : false;
    }


    /**
     * Build a query based on the pieces necessary to perform the statement.
     *
     * SELECT
     * INSERT
     * UPDATE
     * DELETE
     *
     * @access private
     * @param  string  $statement
     * @return mixed
     */
    private function buildQuery($statement = '')
    {
        switch($statement) {

            case 'select':
                return $this->selectStatement();

            case 'insert':
                break;

            case 'update':
                break;

            case 'delete':
                break;

            default:
                return false;
        }

    }


    /**
     * Build a 'select' statement.
     *
     * @access private
     * @return string  (select statement.)
     */
    private function selectStatement()
    {

        if (is_string($this->table) === true) {
            $this->query.= " FROM {$this->table}";
            $this->table = null;
        }

        if (! empty($this->joins)) {
            $this->query.= ' ' . join(' ', $this->joins);
            $this->joins = array();
        }

        if (! empty($this->where)) {
            $where = join(' ', $this->where);
            $where = preg_replace('/^AND|OR|IN|NOT IN/i', ' WHERE', $where);
            $this->query.= $where;
            $this->where = array();
        }

        if (! empty($this->order)) {
            $this->query.= ' ORDER BY ' . join(', ', $this->order);
            $this->order = array();
        }

        return $this->query.= ';';
    }


    // end class...
}

/* End of file QueryBuilder.php */
/* Location: ./(<application folder>/libraries/<namespace>)/QueryBuilder.php */
