<?php namespace Sidex\Http\Controller;

use \Sidex\Http\Request\Url as Url;
use \Sidex\Http\Controller\FrontControllerInterface as FrontControllerInterface;

class FrontController implements FrontControllerInterface {

    const DEFAULT_CONTROLLER = 'IndexController';
    const DEFAULT_ACTION     = 'index';

    private $controller    = self::DEFAULT_CONTROLLER;
    private $action        = self::DEFAULT_ACTION;
    private $params        = array();
    private $uriSegments   = array('controller', 'action', 'params');

    /**
     * FrontController class constructor.
     *
     * @param  array $params (the array of configuration attributes).
     * @return void
     */
    public function __construct(array $params = array())
    {
        $this->setConfiguration($params);
        $this->getClientRequest(new Url);
    }

    /**
     * Takes an array of values to set as configuration attributes.
     *
     * @param  array $options (the array of values).
     * @return void
     */
    public function setConfiguration(array $options)
    {
        foreach ($options as $key=>$value) {
            $this->setConfig($key, $value);
        }
    }

    /**
     * Set a value as configuration attribute.
     *
     * @param  string $attribute (the attribute name).
     * @param  mixed  $value
     * @return void
     */
    public function setConfig($attribute, $value)
    {
        if (isset($this->{$attribute}) and is_null($value) === false) {
            $this->{$attribute} = $value;
        }
    }

    /**
     * Gets the client request.
     *
     * @param  Sidex\Http\Request\Url Object in $Url
     * @return void
     */
    public function getClientRequest(Url $Url)
    {
        $requestUri = $Url->requestUri();

        if ($requestUri == '') {
            return;
        }

        $this->configureRequest($requestUri);
    }

    /**
     * Configure the client request.
     *
     * @param  string $uri (the requested uri.)
     * @return void
     */
    public function configureRequest($uri)
    {
        $segments = explode('/', $uri, 3);

        // Gets all available segments in the uri:
        foreach ($this->uriSegments as $key => $val) {
            ${$val} = isset ($segments[$key])? $segments[$key] : null;
        }

        if (isset($controller)) {
            $this->setController($controller);
        }

        if (isset($action)) {
            $this->setAction($action);
        }

        if (isset($params)) {
            $this->setParams(explode('/', $params));
        }
    }

    /**
     * Sets a controller name to be instantiated if the controller exists in the
     * controller's folder without namespace.
     *
     * @param  string $controller (the controller name.)
     * @return Sidex\Http\Controller\FrontController Object
     */
    public function setController($controller)
    {
        $controller = ucfirst(strtolower($controller)) . 'Controller';

        if (! class_exists($controller)) {
            throw new \InvalidArgumentException("The controller: '{$controller}' does not exists.");
        }

        $this->controller = $controller;
        return $this;
    }

    /**
     * Sets a action name to be called if the action exists in the instantiated
     * controller.
     *
     * @param  string $action (the action name.)
     * @return Sidex\Http\Controller\FrontController Object
     */
    public function setAction($action)
    {
        $reflector = new \ReflectionClass($this->controller);

        if (! $reflector->hasMethod($action)) {
            throw new \InvalidArgumentException("Action: '{$action}' not defined.");
        }

        $this->action = $action;
        return $this;
    }

    /**
     * The parameters to be passed to the controller action, as an indexed
     * array.
     *
     * @param  array  $params
     * @return Sidex\Http\Controller\FrontController Object
     */
    public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * Call a callback with an array of parameters.
     *
     * @return void
     */
    public function run()
    {
        call_user_func_array([new $this->controller, $this->action], $this->params);
    }

    // end class...
}

/* End of file FrontController.php */
/* Location: ./(<application folder>/libraries/<namespace>)/FrontController.php */
