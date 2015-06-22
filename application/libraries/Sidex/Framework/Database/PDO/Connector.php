<?php namespace Sidex\Framework\Database\PDO;

use PDO;

class Connector {


    /**
     * PDO Object
     *
     * @access protected
     */
    protected $pdo;


    protected function connect()
    {
        $config = $this->dbconfig('config/database.php');
        extract(require $config);

        $this->pdo = new PDO($dsn, $username, $password, $options);

        foreach($queryes as $q) {
            $this->pdo->prepare($q)->execute();
        }

        return $this->pdo;
    }


    protected function dbconfig($path)
    {
        return application_path($path);
    }


    // end class...
}

/* End of file Connector.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Connector.php */
