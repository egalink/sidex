<?php namespace Sidex\Framework\Database\PDO;

use PDO;

class Connector {


    protected $db;


    protected function connect()
    {
        $config = $this->dbconfig('config/database.php');
        extract(require $config);

        $this->db = new PDO($dsn, $username, $password, $options);

        foreach($queryes as $q) {
            $this->db->prepare($q)->execute();
        }

        return $this->db;
    }


    protected function dbconfig($path)
    {
        return application_path($path);
    }


    // end class...
}

/* End of file Connector.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Connector.php */
