<?php  if ( ! defined('APPPATH')) exit('No direct script access allowed.');

use \Sidex\Http\Response\View as View;

class IndexController {

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
        $view->make('IndexController/index')
             ->with('title', 'Jakim says..')
             ->with('message', 'Hi Welcome to Sidex Framework!');
        // and more code here...
        $view->render();
    }

}

/* End of file IndexController.php */
/* Location: ./(<application folder>/)controllers/IndexController.php */
