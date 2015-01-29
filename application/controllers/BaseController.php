<?php  if ( ! defined('APPATH')) exit('No direct script access allowed.');

use \Sidex\Http\Response\View as View;

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
        $view = new View();
        $view->make('BaseController/index')
             ->with('title', 'Sidex says..')
             ->with('message', 'Hi Welcome to Sidex Framework!');
        // and more code here...
        $view->render();
    }

}

/* End of file BaseController.php */
/* Location: ./(<application folder>/)controllers/BaseController.php */
