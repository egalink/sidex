<?php namespace Sidex\Http\Response;

use Exception;

class View {

    const VIEW_FOLDER = 'views';

    private $viewFile;
    private $viewVars = array();
    private $viewPath = self::VIEW_FOLDER;

    /**
     * View class constructor.
     *
     * @param  string $view (the view name.)
     * @param  array  $variables
     * @return void
     */
    public function __construct($view = '', array $variables = array())
    {
        if ($view != '') {
            $this->make($view);
        }

        foreach($variables as $var => $val) {
            $this->with($var, $val);
        }
    }


    public function make($view = '')
    {
        if (is_string($view) and $view != '') {
            $this->setView($view);
        } else throw new Exception("The view name is not set correctly.");

        return $this;
    }


    public function with($name = '', $value = null)
    {
        if ($name != '') {
            $this->viewVars[$name] = $value;
        }

        return $this;
    }


    public function render($output = true)
    {
        if (! $this->viewFile) {
            throw new Exception("You may need to include a view.");
        }

        $buffer = $this->content();

        if (! $output) {
            return $buffer;
        }

        echo $buffer;
    }


    private function content()
    {
        if (! empty($this->viewVars)) {
            extract($this->viewVars);
        }

        ob_start();
        require_once $this->viewFile;
        return ob_get_clean();
    }


    private function setView($view = '')
    {
        $viewPath = sprintf("%s/%s.php", APPATH . $this->viewPath, $view);
        $viewFile = $this->buildpath($viewPath);
        $this->viewFile = $viewFile;

        if (is_file($this->viewFile) === false) {
            throw new Exception("The view file not exists in: {$viewFile}.");
        }
    }


    private function buildpath($path = '')
    {
        $path = str_replace('\\','/', $path);
        $path = preg_replace('/\/+/', '/', $path);
        return $path;
    }


    // end class...
}

/* End of file View.php */
/* Location: ./(<application folder>/libraries/<namespace>)/View.php */
