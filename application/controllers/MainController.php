<?php if ( ! defined('APPATH')) exit('No direct script access allowed.');

class MainController {

    /**
     * Say Hello!
     *
     * @access public
     */
    public function index()
    {
        $view = new View('MainController/index', [
            'title'    => 'Sidex Framework',
            'greeting' => 'Hi Welcome to Sidex Framework!',
        ]);

        // and more code here...
        $view->render();
    }

    // end class...
}

/* End of file MainController.php */
/* Location: ./(<application folder>/)controllers/MainController.php */
