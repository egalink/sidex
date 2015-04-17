<?php namespace Sidex\Framework\Controller;

use ReflectionClass,
    InvalidArgumentException;
use Sidex\Framework\Request\Url;

class FrontController implements FrontControllerInterface {

    protected $controller  = self::DEFAULT_CONTROLLER;
    protected $action      = self::DEFAULT_ACTION;
    protected $params      = array();
    protected $uriSegments = array('controller', 'action', 'params');

    /**
     * Constructor.
     *
     * @param  array  $options
     */
    public function __construct(array $options = array())
    {
        $this->configure($options);
        $this->getClientRequest(new Url);
    }

    /**
     * Sets a controller name to be instantiated.
     *
     * @param  string $controller (the controller name)
     * @return Sidex\Framework\Controller\FrontController Object
     */
    public function setController($controller)
    {
        $controller = ucfirst(strtolower($controller)) . 'Controller';

        if (! class_exists($controller)) {
            throw new InvalidArgumentException("The controller: '{$controller}' does not exists.");
        }

        $this->set('controller', $controller);
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

        $this->set('action', $action);
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
        $this->set('params', $params);
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

    /**
     * Takes an array of values to set as configuration attributes.
     *
     * @access protected
     * @param  array  $options (the array of values)
     */
    protected function configure(array $options)
    {
        foreach ($options as $key => $val) $this->set($key, $val);
    }

    /**
     * Set a value as configuration attribute.
     *
     * @access protected
     * @param  string $attribute (the attribute name)
     * @param  mixed  $value
     */
    protected function set($attribute, $value)
    {
        if (isset($this->{$attribute}) === true) $this->{$attribute} = $value;
    }

    /**
     * Gets the client request.
     *
     * @access private
     * @param  Sidex\Framework\Request\Url Object in $url
     */
    private function getClientRequest(Url $url)
    {
        $ruri = $url->requestUri();

        if ($ruri != '') {
            $this->configureRequest($ruri);
        }
    }

    /**
     * Configures the client request.
     *
     * @access private
     * @param  string $uri (the requested uri)
     */
    private function configureRequest($uri)
    {
        $segments = explode('/', $uri, 3);

        // gets all available segments in the uri:
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

    // end class...
}

/* End of file FrontController.php */
/* Location: ./(<application folder>/libraries/<namespace>)/FrontController.php */
