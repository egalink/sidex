<?php namespace Sidex\Session\Manager;

class Session {

    /**
     * Constructor de la clase.
     *
     * @access public
     */
    public function __construct()
    {
        $this->sessionStart();
    }

    /**
     * Configure the session class.
     *
     * @access public
     * @param  array  $config
     */
    public function configure(array $config = array())
    {
        debug($config);exit;
    }

    /**
     * Crear una cookie para guardar el ID de la sesión del usuario.
     *
     * @access public
     * @return mixed
     */
    public function sendCookie($name = '')
    {
        if (empty($_COOKIE[$name]) === true) {
            $this->setCookie($name, $value, 3600);
        }

        return $_COOKIE[$name];
    }

    /**
     * Iniciar una nueva sesión o reanudar la existente.
     *
     * @access protected
     * @return void
     */
    protected function sessionStart()
    {
        session_start();
    }

    /**
     * Define una cookie para ser enviada junto con el resto de las cabeceras
     * de HTTP.
     *
     * @access protected
     * @param  string  $cookie
     * @param  mixed   $value
     * @param  integer $time
     * @return boolean
     */
    protected function setCookie($cookie, $value, $time = 3600)
    {
        return setcookie($cookie, $value, time()+ $time);
    }

    // end class...
}

/* End of file Session.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Session.php */
