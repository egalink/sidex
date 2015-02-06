<?php namespace Sidex\Database\PDO;

use Exception,
    InvalidArgumentException,
    Sidex\Database\PDO\Connectors\MySqlConnector;

class Connection {

    /**
     * A simple PDO connection instance.
     *
     * @var PDO Object
     */
    public $pdo;

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

        $this->pdo = $this->make($config);
    }

    /**
     * Establish a PDO connection based on the configuration.
     *
     * @param  array
     * @return PDO Object
     *
     * @throws InvalidArgumentException
     */
    public function make(array $config)
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
