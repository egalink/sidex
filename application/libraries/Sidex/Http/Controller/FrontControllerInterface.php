<?php namespace Sidex\Http\Controller;

interface FrontControllerInterface {

    public function __construct(array $params);
    public function setConfiguration(array $options);
    public function setConfig($attribute, $value);
    public function getClientRequest(\Sidex\Http\Request\Url $url);
    public function configureRequest($ruri);
    public function setController($controller);
    public function setAction($action);
    public function setParams(array $params);
    public function run();

}

/* End of file FrontControllerInterface.php */
/* Location: ./(<application folder>/libraries/<namespace>)/FrontControllerInterface.php */
