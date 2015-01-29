<?php  if ( ! defined('APPATH')) exit('No direct script access allowed.');

class BaseController {

    /**
     * Class constructor.
     *
     * @access public
     */
    public function __construct()
    {
        // do stuff...
    }

    /**
     * Say Hello!
     *
     * @access public
     */
    public function index()
    {
        $view = new View;
        $view->make('BaseController/index')
             ->with('title', 'Sidex Framework')
             ->with('message', 'Hi Welcome to Sidex Framework!');
        // and more code here...
        $view->render();
    }

    // end class...
}

/* End of file BaseController.php */
/* Location: ./(<application folder>/)controllers/BaseController.php */
