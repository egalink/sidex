<? namespace Sidex\Http\Request;

interface UrlInterface {

	public function parseUrl($url = '/');
	public function requestUri();
	public function performUrl($uri = '');
	public function baseUrl($uri = '');

}

/* End of file UrlInterface.php */
/* Location: ./(<application folder>/libraries/<namespace>)/UrlInterface.php */
