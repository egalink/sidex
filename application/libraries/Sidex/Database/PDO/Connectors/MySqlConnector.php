<?php namespace Sidex\Database\PDO\Connectors;

use PDO;

class MySqlConnector implements ConnectorInterface {

    /**
     * A simple PDO connection instance.
     *
     * @var PDO Object
     */
    public $pdo;

    /**
     * Establish a database connection.
     *
     * @param  array
     * @return PDO Object
     */
    public function connect(array $config)
    {
        extract($config);
        $this->pdo = new PDO($dsn, $username, $password, $options);

        foreach($queryes as $q) {
            $this->pdo->prepare($q)->execute();
        }

        return $this->pdo;
    }

    // end class...
}

/* End of file MySqlConnector.php */
/* Location: ./(<application folder>/libraries/<namespace>)/MySqlConnector.php */
