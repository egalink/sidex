<?php namespace Sidex\Database\PDO;

interface ConnectionInterface {


    /**
     * Establish a database connection.
     *
     * @throws Exception
     */
    public function run();


    /**
     * Create a select statement for the database.
     *
     * @param  string | mixed.
     * @return Object
     */
    public function select($query = '*');


    /**
     * Set the table which the query is targeting.
     *
     * @param  string
     * @return Object
     */
    public function table($table = null);


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
    public function where($column, $operator = null, $value = null, $boolean = 'and');


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
    public function join($table, $one, $operator = null, $two = null, $type = 'inner');


    /**
     * Add a inner join clause to the query.
     *
     * @param string  $table
     * @param string  $one
     * @param string  $operator
     * @param string  $two
     * @return Object
     */
    public function ijoin($table, $one, $operator = null, $two = null);


    /**
     * Add a left join clause to the query.
     *
     * @param string  $table
     * @param string  $one
     * @param string  $operator
     * @param string  $two
     * @return Object
     */
    public function ljoin($table, $one, $operator = null, $two = null);


    /**
     * Add a right join clause to the query.
     *
     * @param string  $table
     * @param string  $one
     * @param string  $operator
     * @param string  $two
     * @return Object
     */
    public function rjoin($table, $one, $operator = null, $two = null);


    /**
     * Add an "order by" clause to the query.
     *
     * @param  string $column
     * @param  string $direction
     * @return Object
     */
    public function order($column, $direction = 'asc');


    // end interface...
}

/* End of file ConnectionInterface.php */
/* Location: ./(<application folder>/libraries/<namespace>)/ConnectionInterface.php */
