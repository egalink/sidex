<?php namespace Sidex\Http\Controller;

use \Sidex\Http\Request\Url as Url;
use \Sidex\Http\Controller\FrontControllerInterface as FrontControllerInterface;

class FrontController implements FrontControllerInterface {


    const DEFAULT_CONTROLLER = 'IndexController';
    const DEFAULT_ACTION     = 'index';


    protected $controller    = self::DEFAULT_CONTROLLER;
    protected $action        = self::DEFAULT_ACTION;
    protected $params        = array();
    protected $uriSegments   = ['controller', 'action', 'params'];


    public function __construct(array $options = array())
    {
        foreach ($options as $key=>$value) {
            $this->setConfig($key, $value);
        }

        $this->getClientRequest(new Url);
    }


    public function setConfig($attribute, $value)
    {
        if (isset($this->{$attribute}) and ! is_null($value)) {
            $this->{$attribute} = $value;
        }
    }


    public function getClientRequest(Url $url)
    {
        $ruri = $url->requestUri();

        if ($ruri == '') {
            return;
        }

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
