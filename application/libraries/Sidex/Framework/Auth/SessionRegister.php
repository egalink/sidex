<?php namespace Sidex\Framework\Auth;

use PDO;
use Sidex\Framework\Database\PDO\Connector;

class SessionRegister extends Connector {


    const DATABASE_TABLE = 'session';


    /**
     * The name of the session database table.
     *
     * @var string
     */
    protected $table = self::DATABASE_TABLE;


    /**
     * Constructor.
     *
     * @param  array  $options
     */
    public function __construct(array $options = array())
    {
        $this->connect();
    }


    /**
     * Find a row into the session database table.
     *
     * @access public
     * @param  array  $data
     * @return mixed
     */
    public function select(array $data)
    {
        extract($data);

        $sql = "SELECT * FROM {$this->table} WHERE session_id = :session_id AND ip_address = :ip_address;";
        $sth = $this->pdo->prepare($sql);

        $sth->execute([
            ':session_id' => $session_id,
            ':ip_address' => $ip_address,
        ]);

        return $sth->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Create a new session register.
     *
     * @access public
     * @param  array  $data
     * @return void
     */
    public function insert(array $data = array())
    {
        extract($data);

        $sql = "INSERT INTO {$this->table} SET session_id = :session_id, ip_address = :ip_address, user_agent = :user_agent, serialized = :serialized;";
        $sth = $this->pdo->prepare($sql);

        $sth->execute([
            ':session_id' => $session_id,
            ':ip_address' => $ip_address,
            ':user_agent' => $user_agent,
            ':serialized' => serialize($serialized),
        ]);

        return;
    }


    /**
     * Update a existent session register.
     *
     * @access protected
     * @param  string  $key
     * @param  array   $data
     * @return void
     */
    protected function update($key, array $data = array())
    {
        extract($data);

        $sql = "UPDATE {$this->table} SET session_id = :session_id, serialized = :serialized WHERE session_id = :old_sessid AND ip_address = :ip_address;";
        $sth = $this->pdo->prepare($sql);

        $sth->execute([
            // to update:
            ':session_id' => $session_id,
            ':serialized' => serialize($serialized),
            // condition:
            ':old_sessid' => $key,
            ':ip_address' => $ip_address,
        ]);

        return;
    }


    // end class.
}

/* End of file SessionRegister.php */
/* Location: ./(<application folder>/libraries/<namespace>)/SessionRegister.php */
