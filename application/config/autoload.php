<?php  if ( ! defined('APPPATH')) exit('No direct script access allowed.');

/**
 * ----------------------------------------------------------------------------
 * RESOURCE LOAD PATHS
 * ----------------------------------------------------------------------------
 *
 * In addition to the Composer class loader, you can use the core class
 * loader for load controllers, models, libraries or another resources under
 * PHP PSR-0 standar.
 *
 */

return array(

    /**
     * THE CONTROLLERS FOLDER:
     *
     * Contains your application’s controllers and their components.
     */
    application_path('controllers/'),


    /**
     * THE MODELS FOLDER:
     *
     * Contains your application’s models.
     */
    application_path('models/'),


    /**
     * THE LIBRARIES FOLDER:
     *
     * Contains libraries that do not come from 3rd parties or external vendors.
     * This allows you to separate your organization’s internal libraries from
     * vendor libraries.
     */
    application_path('libraries/'),

);

/* End of file autoload.php */
/* Location: ./(<application folder>/)config/autoload.php */
