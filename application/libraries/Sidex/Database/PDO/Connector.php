<?php namespace Sidex\Database\PDO;

use Exception,
    InvalidArgumentException,
    Sidex\Database\PDO\Connectors\MySqlConnector;

class Connector {

    /**
     * A simple PDO connection instance.
     *
     * @var PDO Object
     */
    public $db;

    /**
     * Establish a database connection.
     *
     * @return void
     * @throws Exception
     */
    public function __construct()
    {
        $config = require $this->buildpath(APPATH . 'config/database.php');

        if (empty($config) === true) {
            throw new Exception ("You may specify a database connection.");
        }

        $this->db = $this->make($config);
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

        $PDOob = $this->createConnection($config['driver'])->connect($config);
        return $PDOob;
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

/* End of file Connector.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Connector.php */
