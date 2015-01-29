<? namespace Sidex\Http\Request;

interface UrlInterface {

    /**
     * Url class constructor.
     *
     * @return void
     */
    public function __construct();

    /**
     * Parse a correct functionally URL for the application.
     *
     * @param  string $url (The URL to parse.)
     * @return string
     */
    public function parseUrl($url = '/');

    /**
     * Returns the URI which was given in order to access to any page from
     * the application.
     *
     * @return string (the requested URI.)
     */
    public function requestUri();

    /**
     * Generate a absolute URL.
     *
     * @return URL
     */
    public function performUrl();

    /**
     * Generate a absolute URL to the given path.
     *
     * @param  string  $uri (default empty.)
     * @return URL
     */
    public function siteUrl($uri = '');

    /**
     * Generate a URL to an application asset.
     *
     * @param  string  $uri (default empty.)
     * @return URL to an asset
     */
    public function baseUrl($uri = '');

    // end interface...
}

/* End of file UrlInterface.php */
/* Location: ./(<application folder>/libraries/<namespace>)/UrlInterface.php */
