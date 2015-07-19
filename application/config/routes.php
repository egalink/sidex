<?php if ( ! defined('APPATH')) exit('No direct script access allowed.');

return array(

    /**
     * Route Example:
     *
     * 'users/(:id)/edit'  => [
     *     'name'          => 'UsersController::index',
     *     'controller'    => 'UsersController',
     *     'action'        => 'index',
     *     'method'        => 'get',
     *     'filters'       => array(':id' => '[0-9]+'),
     * ],
     */

    '/' => ['controller' => 'BaseController', 'action' => 'index'],
);

/* End of file routes.php */
/* Location: ./(<application folder>/)config/routes.php */
