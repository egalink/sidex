<?php namespace Sidex\Database\PDO;

class Builder {

    /**
     * Create a new query builder instance.
     *
     * @access private
     * @var QueryBuilder Object
     */
    private $queryBuilder;


    /**
     * Create a new query builder instance.
     *
     * @access public
     * @param  QueryBuilder Object  $queryBuilder
     * @return string
     */
    public function buildQuery(QueryBuilder &$queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;

        switch($this->queryBuilder->current) {

            case 'SELECT':
                return $this->buildSelectStatement();

            default:
                return false;
        }
    }


    /**
     * Build the query as a "select" statement.
     *
     * @access public
     * @return string
     */
    public function buildSelectStatement()
    {
        $query = strtoupper($this->queryBuilder->current) . ' ';
        $query.= $this->queryBuilder->distinct ? 'DISTINCT ' : '';
        $query.= $this->queryBuilder->columns . ' ';
        $query.= 'FROM ' . $this->queryBuilder->table . ' ';

        if (! empty($this->queryBuilder->joins)) {
            $query.= join(' ', $this->queryBuilder->joins) . ' ';
        }

        if (! empty($this->queryBuilder->wheres)) {
            $where = join(' ', $this->queryBuilder->wheres);
            $query.= 'WHERE';
            $query.= preg_replace('/^(AND|OR)/i', '', $where) . ' ';
        }

        if (! empty($this->queryBuilder->orders)) {
            $order = join(', ', $this->queryBuilder->orders);
            $query.= 'ORDER BY ' . $order . ' ';
        }

        if (is_numeric($this->queryBuilder->limit)) {
            $query.= 'LIMIT ' . $this->queryBuilder->limit;
        }

        $this->queryBuilder->query = trim($query);
        return $query;
    }


    // end class...
}

/* End of file QueryBuilder.php */
/* Location: ./(<application folder>/libraries/<namespace>)/QueryBuilder.php */
