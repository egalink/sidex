<?php namespace Sidex\Database\PDO\Connectors;

interface ConnectorInterface {


    /**
     * Establish a database connection with PDO.
     *
     * @param  array
     * @return PDO Object
     */
    public function connect(array $config);


    // end interface...
}

/* End of file ConnectorInterface.php */
/* Location: ./(<application folder>/libraries/<namespace>)/ConnectorInterface.php */
