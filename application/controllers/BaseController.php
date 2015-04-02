<?php  if ( ! defined('APPATH')) exit('No direct script access allowed.');

class BaseController {

    /**
     * Say Hello!
     *
     * @access public
     */
    public function index()
    {
        $view = new View('BaseController/index', [
            'title'    => 'Sidex Framework',
            'greeting' => 'Hi Welcome to Sidex Framework!',
        ]);

        // and more code here...
        $view->render();
    }

    // end class...
}

/* End of file BaseController.php */
/* Location: ./(<application folder>/)controllers/BaseController.php */
