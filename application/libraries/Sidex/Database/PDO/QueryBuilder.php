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
     * The "raw" expression from the query.
     *
     * @var string
     */
    public $query = '';


    /**
     * The current query statement.
     *
     * @var string
     */
    public $current;


    /**
     * The current query value bindings.
     *
     * @var array
     */
    public $bindings = array();


    /**
     * The columns that should be returned.
     *
     * @var string
     */
    public $columns;


    /**
     * Indicates if the query returns distinct results.
     *
     * @var bool
     */
    public $distinct = false;


    /**
     * The table which the query is targeting.
     *
     * @var string
     */
    public $table;


    /**
     * The table joins for the query.
     *
     * @var array
     */
    public $joins;


    /**
     * The where constraints for the query.
     *
     * @var array
     */
    public $wheres;


    /**
     * The orderings for the query.
     *
     * @var array
     */
    public $orders;


    /**
     * The maximum number of records to return.
     *
     * @var int
     */
    public $limit;


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
     * Set the columns to be selected.
     *
     * @param  mixed  $columns
     * @return $this
     */
    public function select($columns = '*')
    {
        if (func_num_args() > 1)
            $columns = func_get_args();

        if (is_array($columns))
            $columns = join(', ', $columns);

        $this->current = 'SELECT';
        $this->columns = $columns;

        return $this;
    }


    /**
     * Force the query to only return distinct results.
     *
     * @return $this
     */
    public function distinct()
    {
        $this->distinct = true;
        return $this;
    }


    /**
     * Set the table which the query is targeting.
     *
     * @param  mixed  $table
     * @return $this
     */
    public function from($table)
    {
        if (func_num_args() > 1)
            $table = func_get_args();

        if (is_array($table))
            $table = join(', ', $table);

        $this->table = $table;
        return $this;
    }


    /**
     * Add a join clause to the query.
     *
     * @param  string  $table
     * @param  string  $one
     * @param  string  $operator
     * @param  string  $two
     * @param  string  $type
     * @param  bool    $where
     * @return $this
     */
    public function join($table, $one, $operator = null, $two = null, $type = '')
    {
        $join = count($this->joins);
        $this->joins[$join] = ltrim(strtoupper($type) . ' JOIN ');
        $this->joins[$join].= rtrim("{$table} ON {$one} {$operator} {$two}");
        return $this;
    }


    /**
     * Add a inner join to the query.
     *
     * @param  string  $table
     * @param  string  $one
     * @param  string  $operator
     * @param  string  $two
     * @return $this
     */
    public function innerJoin($table, $one, $operator = null, $two = null)
    {
        return $this->join($table, $one, $operator, $two, 'inner');
    }


    /**
     * Add a left join to the query.
     *
     * @param  string  $table
     * @param  string  $one
     * @param  string  $operator
     * @param  string  $two
     * @return $this
     */
    public function leftJoin($table, $one, $operator = null, $two = null)
    {
        return $this->join($table, $one, $operator, $two, 'left');
    }


    /**
     * Add a right join to the query.
     *
     * @param  string  $table
     * @param  string  $one
     * @param  string  $operator
     * @param  string  $two
     * @return $this
     */
    public function rightJoin($table, $one, $operator = null, $two = null)
    {
        return $this->join($table, $one, $operator, $two, 'right');
    }


    /**
     * Add a basic where clause to the query.
     *
     * @param  mixed   $column
     * @param  string  $operator
     * @param  mixed   $value
     * @param  string  $boolean
     * @return $this
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        $where = count($this->wheres);

        if (is_array($column)) {
            $this->whereArray($column);
        } else {

            $this->wheres[$where] = strtoupper($boolean) . ' ';
            $this->wheres[$where].= $column . ' ';
            $this->wheres[$where].= is_string($operator) ? "{$operator} ?" : '?';
            $this->bind($value);
        }

        return $this;
    }


    /**
     * Add a clause 'where' to the query from an array of data.
     *
     * @param  array   $columns
     * @param  string  $boolean
     * @return $this
     */
    public function whereArray(array $columns = array(), $boolean = 'and')
    {
        foreach($columns as $column => $value) {
            $this->where($column, '=', $value, $boolean);
        }

        return $this;
    }


    /**
     * Add a binding to the query.
     *
     * @param  mixed   $value
     * @param  string  $parameter
     * @return $this
     */
    public function bind($value, $parameter = null)
    {
        if (is_null($parameter)) {
            $this->bindings[] = $value;
        } else {
            $this->bindings[$parameter] = $value;
        }

        return $this;
    }


    /**
     * Add an "order by" clause to the query.
     *
     * @param  string  $column
     * @param  string  $direction
     * @return $this
     */
    public function order($column, $direction = 'asc')
    {
        $direction = strtoupper($direction);
        $this->orders[] = "{$column} {$direction}";
        return $this;
    }


    /**
     * Add an "order by asc" clause to the query.
     *
     * @param  mixed   $column
     * @param  string  $direction
     * @return $this
     */
    public function orderAsc($column)
    {
        if (func_num_args() > 1) {

            foreach(func_get_args() as $column) {
                $this->order($column, 'asc');
            }

        } else {
            $this->order($column, 'asc');
        }

        return $this;
    }


    /**
     * Add an "order by desc" clause to the query.
     *
     * @param  mixed   $column
     * @param  string  $direction
     * @return $this
     */
    public function orderDesc($column)
    {
        if (func_num_args() > 1) {

            foreach(func_get_args() as $column) {
                $this->order($column, 'desc');
            }

        } else {
            $this->order($column, 'desc');
        }

        return $this;
    }


    /**
     * Set the "limit" value of the query.
     *
     * @param  int  $value
     * @return $this
     */
    public function limit($value)
    {
        $this->limit = (int) $value;
        return $this;
    }


    /**
     * Execute the query as a "select" statement.
     *
     * @return array
     */
    public function get()
    {
        $query = $this->buildQuery();
        $sth = $this->db->prepare($query);
        $sth->execute($this->bindings);
        $sth->fetchAll();
        debug($this);exit;
    }


    // ------------------------------------------------------------------------
    // PRIVATE METHODS --------------------------------------------------------
    // ------------------------------------------------------------------------


    /**
     * Create a new query based on the "current" statement.
     *
     * @access private
     * @return string
     */
    private function buildQuery()
    {
        switch($this->current) {

            case 'SELECT':
                return $this->buildSelectStatement();

            default:
                return null;
        }
    }


    /**
     * Build the query as a "select" statement.
     *
     * @access private
     * @return string
     */
    private function buildSelectStatement()
    {
        $query = ($this->distinct == true)?
            "SELECT DISTINCT {$this->columns} " : "SELECT {$this->columns} ";

        $query.= "FROM {$this->table} ";

        if (is_array($this->joins))
            $query.= join(' ', $this->joins) . ' ';

        if (is_array($this->wheres))
            $query.= preg_replace('/^(and|or)/i', 'WHERE', join(' ', $this->wheres)) . ' ';

        if (is_array($this->orders))
            $query.= 'ORDER BY ' . join(', ', $this->orders) . ' ';

        if (is_int($this->limit))
            $query.= "LIMIT {$this->limit} ";

        $this->query = preg_replace('/\s+/', ' ', trim($query)) . ';';
        return $this->query;
    }


    // end class...
}

/* End of file QueryBuilder.php */
/* Location: ./(<application folder>/libraries/<namespace>)/QueryBuilder.php */
