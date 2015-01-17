<?php namespace Sidex\Http\Response;

class View {


    const VIEW_FOLDER = 'views';


    protected $viewFile;
    protected $viewVars = array();


    public function __construct($view = '', $params = array())
    {
        if ($view != '') {
            $this->make($view);
        }

        if ($params != array() and is_array($params) === true) {
            foreach ($params as $key => $val) {
                $this->with($key, $val);
            }
        }
    }


    public function render($output = true)
    {
        if (empty($this->viewFile) === true) {
            exit("You may need to include a view.");
        }

        if (! empty($this->viewVars)) {
            extract($this->viewVars);
        }

        ob_start();
        require_once $this->viewFile;
        $content = ob_get_clean();

        if (! $output) {
            return $content;
        }

        echo $content;
    }


    public function make($view = '')
    {
        $this->viewFile = $this->addView($view);
        return $this;
    }


    public function with($name = '', $value = null)
    {
        if (! is_null($value) and $name != '') {
            $this->viewVars[$name] = $value;
        }

        return $this;
    }


    protected function addView($name = null)
    {
        $viewFile = '';

        if (is_string($name) === false) {
            exit("The view name is not set correctly.");
        }

        $viewPath = APPATH . self::VIEW_FOLDER . '/' . $name . '.php';
        $viewFile = $this->buildpath($viewPath);

        if (is_file($viewFile) === false) {
            exit("The view file not exists in: {$viewPath}");
        }

        return $viewFile;
    }


    protected function buildpath($path = '')
    {
        $path = str_replace('\\','/', $path);
        $path = preg_replace('/\/+/', DIRECTORY_SEPARATOR, $path);
        return $path;
    }


    // end class...
}

/* End of file View.php */
/* Location: ./(<application folder>/libraries/<namespace>)/View.php */
