<?php namespace Sidex\Framework\Controller;


class Routing {


    /**
     * The valid configuration arguments to be used in a route.
     *
     * @var array
     */
    private $configArguments = array(
            'name'       => '/',
            'controller' => '',
            'action'     => 'index',
            'method'     => 'get',
            'params'     => array(),
            'filters'    => array(),
        );


    /**
     * Array of allowed routes on the request.
     *
     * @var array
     */
    private $routes = array();


    /**
     * Add routes on the array.
     *
     * @access public
     * @param  array  $routes
     * @return $this
     */
    public function addRoutes(array $routes)
    {
        foreach ($routes as $route => $config) $this->addRoute($route, $config);

        return $this;
    }


    /**
     * Add a route on the allowed routes array.
     *
     * @access public
     * @param  array  $route
     * @param  array  $config
     * @return $this
     */
    public function addRoute($route, array $config)
    {
        $filters = array();
        $matches = array();
        $getting = preg_match_all('/\((\:.*?)\)/', $route, $matches, PREG_SET_ORDER);

        // the valid configuration to be used in the current route:
        $config = $this->routeConfiguration($config);

        // if the pattern matches (which might be zero), set the filters in a
        // route with the correct regexp:
        if ($getting > 0)
            $route = $this->routeFilters($route, $matches, $config['filters']);

        $this->routes[trim($route, '/')] = $config;

        return $this;
    }


    /**
     * Get the requested route.
     *
     * @access public
     * @param  string  $ruri
     * @param  string  $method
     * @return array
     */
    public function getRoute($ruri, $method)
    {
        $request = array();

        foreach ($this->routes as $route => $config) {

            $matches = array();
            $getting = preg_match($this->routePattern($route), $ruri, $matches);
            $request = $this->requestedRoute([
                'route'   => $route,
                'method'  => $method,
                'config'  => $config,
                'getting' => $getting,
                'matches' => $matches,
            ]);

            if (! empty($request)) break;
        }

        return $request;
    }


    /**
     * Set the configuration from a route.
     *
     * @access private
     * @param  array  $config
     * @return array
     */
    private function routeConfiguration(array $config)
    {
        $filter = $this->configArguments;
        $config = array_intersect_key($config, $filter);
        $config = array_merge($filter, $config);

        return $config;
    }


    /**
     * Set the filters in a route with the correct regexp pattern.
     *
     * @access private
     * @param  string  $route
     * @param  array   $matches
     * @param  array   $filters
     */
    private function routeFilters($route, array $matches, array $filters)
    {
        foreach ($matches as $position) {
            $search = $position[0];
            $regexp = $position[1];
            $route = str_replace($search, '(' . $filters[$regexp] . ')', $route);
        }

        return $route;
    }


    /**
     * Return a formatted string to regexp pattern.
     *
     * @access private
     * @param  string  $route
     * @return regexp pattern
     */
    private function routePattern($route)
    {
        return sprintf("/%s/", str_replace('/', '\/', $route));
    }


    /**
     * Get the requested route configuration available in the routes array.
     *
     * @access private
     * @param  array  $data
     * @reutrn array
     */
    private function requestedRoute(array $data)
    {
        extract($data);

        $rmethod = strtolower($method);
        $cmethod = strtolower($config['method']);
        $inArray = in_array($route, array_keys($this->routes), 1);

        if ($getting > 0 and ($rmethod === $cmethod) and $inArray === true) {
            array_shift($matches);
            $request = array_merge($this->routes[$route], ['params' => $matches]);
        } else {
            $request = array();
        }

        return $request;
    }


    // end class.
}

/* End of file Routing.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Routing.php */
