<?php namespace Sidex\Framework\Request;

interface UrlInterface {

    /**
     * Returns the URI which was given in order to access to any page from
     * the application.
     *
     * @return string (the requested URI)
     */
    public function requestUri();

    // end interface...
}

/* End of file UrlInterface.php */
/* Location: ./(<application folder>/libraries/<namespace>)/UrlInterface.php */
