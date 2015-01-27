<?php namespace Sidex\Http\Controller;

interface FrontControllerInterface {

    /**
     * Class constructor.
     *
     * @param  array $params (the array of configuration attributes).
     * @return void
     */
    public function __construct(array $params);

    /**
     * Takes an array of values to set as configuration attributes.
     *
     * @param  array $options (the array of values).
     * @return void
     */
    public function setConfiguration(array $options);

    /**
     * Set a value as configuration attribute.
     *
     * @param  string $attribute (the attribute name).
     * @param  mixed  $value
     * @return void
     */
    public function setConfig($attribute, $value);

    /**
     * Gets the client request.
     *
     * @param  Sidex\Http\Request\Url Object in $Url
     * @return void
     */
    public function getClientRequest(\Sidex\Http\Request\Url $url);

    /**
     * Configures the client request.
     *
     * @param  string $uri (the requested uri.)
     * @return void
     */
    public function configureRequest($ruri);

    /**
     * Sets a controller name to be instantiated.
     *
     * @param  string $controller (the controller name.)
     * @return Sidex\Http\Controller\FrontController Object
     */
    public function setController($controller);

    /**
     * Sets the action name to be called from the controller.
     *
     * @param  string $action (the action name.)
     * @return Sidex\Http\Controller\FrontController Object
     */
    public function setAction($action);

    /**
     * Sets the parameters to be passed to the controller action, as an indexed
     * array.
     *
     * @param  array  $params
     * @return Sidex\Http\Controller\FrontController Object
     */
    public function setParams(array $params);

    /**
     * Call to the controller action with an array of parameters.
     *
     * @return void
     */
    public function run();

    // end interface...
}

/* End of file FrontControllerInterface.php */
/* Location: ./(<application folder>/libraries/<namespace>)/FrontControllerInterface.php */
