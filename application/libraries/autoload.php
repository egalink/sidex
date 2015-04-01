<?php if (! defined('APPATH')) exit('No direct script access allowed.');

require __DIR__ . '/Sidex/Core/Framework/ClassLoader.php';
class Autoload extends \Sidex\Core\Framework\ClassLoader {

    /**
     * The class constructor.
     *
     * @param  array  $config
     */
    public function __construct(array $config = array())
    {
        $this->configure($config);
    }

    // end class...
}

return new Autoload(require APPATH . 'config/autoload.php');

/* End of file autoload.php */
/* Location: ./(<application folder>/)libraries/autoload.php */
