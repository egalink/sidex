<?php namespace Sidex\Framework\Controller;

interface FrontControllerInterface {


    const DEFAULT_CONTROLLER = 'BaseController';
    const DEFAULT_ACTION     = 'index';


    /**
     * Sets a controller name to be instantiated.
     *
     * @param  string $controller (the controller name)
     * @return Sidex\Framework\Controller\FrontController Object
     */
    public function setController($controller);


    /**
     * Sets the action name to be called from the controller.
     *
     * @param  string $action (the action name)
     * @return Sidex\Framework\Controller\FrontController Object
     */
    public function setAction($action);


    /**
     * Sets the parameters to be passed to the controller action, as an indexed
     * array.
     *
     * @param  array  $params
     * @return Sidex\Framework\Controller\FrontController Object
     */
    public function setParams(array $params);


    /**
     * Call to the controller action with an array of parameters.
     *
     * @return void
     */
    public function run();


    // end interface.
}

/* End of file FrontControllerInterface.php */
/* Location: ./(<application folder>/libraries/<namespace>)/FrontControllerInterface.php */
