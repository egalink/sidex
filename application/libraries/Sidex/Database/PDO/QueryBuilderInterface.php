<?php namespace Sidex\Database\PDO;

interface QueryBuilderInterface {


    /**
     * Set the columns to be selected.
     *
     * @param  mixed  $columns
     * @return $this
     */
    public function select($columns = '*');


    /**
     * Force the query to only return distinct results.
     *
     * @return $this
     */
    public function distinct();


    /**
     * Set the table which the query is targeting.
     *
     * @param  mixed  $table
     * @return $this
     */
    public function from($table);


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
    public function join($table, $one, $operator = null, $two = null, $type = '');


    /**
     * Add a inner join to the query.
     *
     * @param  string  $table
     * @param  string  $one
     * @param  string  $operator
     * @param  string  $two
     * @return $this
     */
    public function innerJoin($table, $one, $operator = null, $two = null);


    /**
     * Add a left join to the query.
     *
     * @param  string  $table
     * @param  string  $one
     * @param  string  $operator
     * @param  string  $two
     * @return $this
     */
    public function leftJoin($table, $one, $operator = null, $two = null);


    /**
     * Add a right join to the query.
     *
     * @param  string  $table
     * @param  string  $one
     * @param  string  $operator
     * @param  string  $two
     * @return $this
     */
    public function rightJoin($table, $one, $operator = null, $two = null);


    /**
     * Add a basic where clause to the query.
     *
     * @param  mixed   $column
     * @param  string  $operator
     * @param  mixed   $value
     * @param  string  $boolean
     * @return $this
     *
     * @throws \InvalidArgumentException
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and');


    /**
     * Add a clause 'where' to the query from an array of data.
     *
     * @param  array   $columns
     * @param  string  $boolean
     * @return $this
     */
    public function whereArray(array $columns = array(), $boolean = 'and');


    /**
     * Add a binding to the query.
     *
     * @param  mixed   $value
     * @param  string  $parameter
     * @return $this
     */
    public function bind($value, $parameter = null);


    /**
     * Add an "order by" clause to the query.
     *
     * @param  string  $column
     * @param  string  $direction
     * @return $this
     */
    public function order($column, $direction = 'asc');


    /**
     * Add an "order by asc" clause to the query.
     *
     * @param  mixed   $column
     * @param  string  $direction
     * @return $this
     */
    public function orderAsc($column);


    /**
     * Add an "order by desc" clause to the query.
     *
     * @param  mixed   $column
     * @param  string  $direction
     * @return $this
     */
    public function orderDesc($column);


    // end interface...
}

/* End of file QueryBuilderInterface.php */
/* Location: ./(<application folder>/libraries/<namespace>)/QueryBuilderInterface.php */
