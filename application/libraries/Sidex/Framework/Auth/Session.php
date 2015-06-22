<?php namespace Sidex\Framework\Auth;

use Sidex\Framework\Input\Input;

class Session {


    /**
     * Sidex\Framework\Input\Input Object
     *
     * @access protected
     */
    protected $input;


    /**
     * The number of SECONDS you want the session to last.
     *
     * @var array
     */
    protected $expire = 7200;


    /**
     * The name of the session cookie name.
     *
     * @var string
     */
    protected $cookie = 'session';


    /**
     * The existent session ID in cookie.
     *
     * @var string
     */
    protected $sessid = '';


    /**
     * Array of session data.
     *
     * @var array
     */
    protected $session = array();


    /**
     * Constructor.
     *
     * @param  array  $options
     */
    public function __construct(array $options = array())
    {
        $this->input = new Input;
        $this->configure($options['session']);
    }


    /**
     * Initialize the functionality.
     *
     * @access public
     * @return array
     */
    public function run()
    {
        $cookieid = $this->getCookieID();

        // create the cookie:
        if ($cookieid === null)
            $cookieid = $this->setCookieID();

        $this->set('sessid', $cookieid);
        $this->retrieveSessionData(new SessionRegister);
    }


    /**
     * Takes an array of values to set as configuration attributes.
     *
     * @access protected
     * @param  array  $options (the array of values)
     */
    protected function configure(array $options)
    {
        foreach($options as $attr => $val) $this->set($attr, $val);
    }


    /**
     * Set a value as configuration attribute.
     *
     * @access protected
     * @param  string $attribute (the attribute name)
     * @param  mixed  $value
     */
    protected function set($attribute, $value)
    {
        $this->{$attribute} = $value;
    }


    /**
     * Get the unique session ID in the cookie.
     *
     * @access protected
     * @return string
     */
    protected function getCookieID()
    {
        $this->input->from('cookie');
        return $this->input->get($this->cookie);
    }


    /**
     * Do the following:
     *
     * 1.- Set the session ID into the cookie session.
     * 2.- Send the session cookie and update the expiration time.
     *
     * @access protected
     * @return string
     */
    protected function setCookieID()
    {
        $sessid = $this->sessid();
        $this->setCookie($sessid);
        return $sessid;
    }


    /**
     * Generate a unique session ID.
     *
     * @access protected
     * @return string
     */
    protected function sessid()
    {
        return sha1(microtime());
    }


    /**
     * Send the session cookie and update the expiration time.
     *
     * @access protected
     * @param  string  $value
     */
    protected function setCookie($value = '')
    {
        setcookie($this->cookie, $value, time() + $this->expire);
    }


    /**
     * Retrieve all current session data.
     *
     * @access protected
     * @param  Sidex\Framework\Auth\SessionRegister Object  $register
     */
    protected function retrieveSessionData(SessionRegister $register)
    {
        $this->input->from('server');

        $sessionData = $register->select([
            'session_id' => $this->sessid,
            'ip_address' => $this->input->get('REMOTE_ADDR'),
        ]);

        if ($sessionData != true) {

            $sessionData = array(
                'session_id' => $this->sessid,
                'ip_address' => $this->input->get('REMOTE_ADDR'),
                'user_agent' => $this->input->get('HTTP_USER_AGENT'),
                'serialized' => array(),
            );

            $register->insert($sessionData);

        } else {

            $sessionData['serialized'] = unserialize($sessionData['serialized']);
        }

        $this->set('session', $sessionData);
    }


    // end class.
}

/* End of file Session.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Session.php */
