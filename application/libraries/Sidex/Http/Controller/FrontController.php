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
     * @access public
     * @param  Sidex\Http\Request\Url Object in $Url
     * @return void
     */
    public function getClientRequest(Url $Url)
    {
        $ruri = $Url->requestUri();

        if ($ruri == '') {
            return;
        }
        // END REVISION 25.01.2015 01:16:24:
        $this->configureRequest($ruri);
    }


    public function configureRequest($ruri)
    {
        $rsegments = explode('/', $ruri, 3);

        foreach ($this->uriSegments as $key => $val) {
            ${$val} = isset($rsegments[$key]) ? $rsegments[$key] : null;
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


    public function setController($controller)
    {
        $controller = ucfirst(strtolower($controller)) . 'Controller';

        if (! class_exists($controller)) {
            throw new \InvalidArgumentException("El controlador: '{$controller}' no existe.");
        }

        $this->controller = $controller;
        return $this;
    }


    public function setAction($action)
    {
        $reflector = new \ReflectionClass($this->controller);

        if (! $reflector->hasMethod($action)) {
            throw new \InvalidArgumentException("El metodo: '{$action}' no esta definido.");
        }

        $this->action = $action;
        return $this;
    }


    public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }


    public function run()
    {
        call_user_func_array([new $this->controller, $this->action], $this->params);
    }


    // end class...
}

/* End of file FrontController.php */
/* Location: ./(<application folder>/libraries/<namespace>)/FrontController.php */
