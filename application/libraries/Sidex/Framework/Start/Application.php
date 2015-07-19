<?php namespace Sidex\Framework\Start;


class Application {


    /**
     * Sidex\Framework\Start\FrontController Object
     *
     * @access protected
     */
    protected $fController;


    /**
     * The constructor
     *
     * @param  array  $config
     */
    public function __construct(array $config = array())
    {
        $this->fController = new FrontController;
    }


    /**
     * Run the application.
     *
     * @access public
     */
    public function run()
    {
        $this->fController->run();
    }


    // end class.
}

/* End of file Application.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Application.php */
