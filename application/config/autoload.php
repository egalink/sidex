<?php  if ( ! defined('APPATH')) exit('No direct script access allowed.');

return array(

    /*
     *-------------------------------------------------------------------------
     * CLASS ALIASES
     *-------------------------------------------------------------------------
     *
     * This array of class aliases will be registered when the application
     * is started. However, feel free to register as many as you wish as
     * the aliases are "lazy" loaded so they don't hinder performance.
     *
     */

    'aliases' => array(

        'View'  => '\Sidex\Http\Response\View',

    ),


    /**
     * ------------------------------------------------------------------------
     * RESOURCE LOAD PATHS
     * ------------------------------------------------------------------------
     *
     * In addition to the Composer class loader, you can use the core class
     * loader for load controllers, models, libraries or another resources
     * under PHP PSR-0 standar.
     *
     */

    'paths' => array(

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

    )

    // end config...
);

/* End of file autoload.php */
/* Location: ./(<application folder>/)config/autoload.php */

