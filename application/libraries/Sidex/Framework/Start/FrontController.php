<?php namespace Sidex\Framework\Start;


use Sidex\Framework\Request\Url;
use Sidex\Framework\Controller\Routing;

class FrontController extends \Sidex\Framework\Controller\FrontController {


    /**
     * The requested URI.
     *
     * @var string
     */
    public $uri = '/';


    /**
     * The requested route.
     *
     * @var array
     */
    public $request = array();


    /**
     * Which request method was used to access the page.
     *
     * @var string
     */
    public $rmethod = 'GET';


    /**
     * Sidex\Framework\Controller\Routing Object
     *
     * @access public
     */
    public $routing;


    /**
     * The constructor.
     *
     * @access public
     */
    public function __construct()
    {
        $this->initializeRoutes(new Routing)->getRouteRequested(new Url);
    }


    /**
     * Initialize the routing from the request.
     *
     * @access public
     * @param  Routing Object  in  $routing
     * @return $this
     */
    public function initializeRoutes(Routing $routing)
    {
        $this->instantiate('routing', $routing);
        $routing->addRoutes(require APPATH . 'config/routes.php');
        return $this;
    }


    /**
     * Add a class instance.
     *
     * @access public
     * @param  string  $instance
     * @param  object  $object
     * @return $this
     */
    public function instantiate($instance, $object)
    {
        $this->{$instance} = $object;
        return $this;
    }


    /**
     * Get the requested URI with configuration values.
     *
     * @access public
     * @param  Url Object  in  $url
     * @return $this
     */
    public function getRouteRequested(Url $url)
    {
        $ruri = $url->requestUri();

        if ($ruri)
            $this->uri = $ruri;
        $this->rmethod = $url->input->get('REQUEST_METHOD'); // from server.
        $this->request = $this->routing->getRoute($this->uri, $this->rmethod);

        if (empty($this->request) === false) {
            $this->setController($this->request['controller']);
            $this->setAction($this->request['action']);
            $this->setParams($this->request['params']);
        } else {
            debug($this);exit;
        }
    }


    // end class.
}

/* End of file FrontController.php */
/* Location: ./(<application folder>/libraries/<namespace>)/FrontController.php */
