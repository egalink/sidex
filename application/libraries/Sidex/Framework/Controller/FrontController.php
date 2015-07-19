<?php namespace Sidex\Framework\Controller;


use ReflectionClass;
use InvalidArgumentException;


class FrontController implements FrontControllerInterface {


    /**
     * The controller class name to be instantiated.
     *
     * @var string
     */
    protected $controller = self::DEFAULT_CONTROLLER;


    /**
     * The action name to be called from the controller.
     *
     * @var string
     */
    protected $action = self::DEFAULT_ACTION;


    /**
     * The parameters to be passed to the controller action, as an indexed
     * array.
     *
     * @var string
     */
    protected $params = array();


    /**
     * The URI segments allowed in the URL request.
     *
     * @var array
     */
    protected $uriSegments = array('controller', 'action', 'params');


    /**
     * Sets a controller name to be instantiated.
     *
     * @param  string $controller (the controller name)
     * @return Sidex\Framework\Controller\FrontController Object
     */
    public function setController($controller)
    {
        if (! class_exists($controller)) {
            throw new InvalidArgumentException("The controller: '{$controller}' does not exists.");
        }

        $this->controller = $controller;
        return $this;
    }


    /**
     * Sets the action name to be called from the controller.
     *
     * @param  string $action (the action name)
     * @return Sidex\Framework\Controller\FrontController Object
     */
    public function setAction($action)
    {
        $reflector = new ReflectionClass($this->controller);

        if (! $reflector->hasMethod($action)) {
            throw new InvalidArgumentException("The action: '{$action}' is not defined.");
        }

        $this->action = $action;
        return $this;
    }


    /**
     * Sets the parameters to be passed to the controller action, as an indexed
     * array.
     *
     * @param  array  $params
     * @return Sidex\Framework\Controller\FrontController Object
     */
    public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }


    /**
     * Call to the controller action with an array of parameters.
     *
     * @return void
     */
    public function run()
    {
        call_user_func_array([new $this->controller, $this->action], $this->params);
    }


    // end class.
}

/* End of file FrontController.php */
/* Location: ./(<application folder>/libraries/<namespace>)/FrontController.php */
