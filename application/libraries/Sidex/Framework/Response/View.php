<?php namespace Sidex\Framework\Response;

use Exception,
    InvalidArgumentException;

class View {

    const VIEW_FOLDER = 'views';

    private $viewFile;
    private $viewVars = array();
    private $viewPath = self::VIEW_FOLDER;

    /**
     * View class constructor.
     *
     * @param  string $view (the view name)
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

    /**
     * Take the name of a view file for display to the user.
     *
     * @param  string  $view (empty string)
     * @return Sidex\Framework\Response\View Object
     */
    public function make($view = '')
    {
        if (is_string($view) and $view != '') {
            $this->setView($view);
        } else {
            throw new InvalidArgumentException("The view name is not set correctly.");
        }

        return $this;
    }

    /**
     * Add a piece of data to the view.
     *
     * @param  string  $name  (the variable name)
     * @param  mixed   $value (default null)
     * @return Sidex\Framework\Response\View Object
     */
    public function with($name = '', $value = null)
    {
        if ($name != '') {
            $this->viewVars[$name] = $value;
        }

        return $this;
    }

    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  boolean $output
     * @return mixed
     */
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
    
    /**
     * Set a new viewPath.
     *
     * @access public
     * @param  string  $path
     * @return Sidex\Framework\Response\View Object
     */
    public function setPath($viewPath)
    {
        $this->viewPath = $this->normalize($viewPath);
        return $this;
    }

    /**
     * Builds a file path with the appropriate directory separator.
     *
     * @access private
     * @param  string
     * @return string path
     */
    private function normalize($path = '')
    {
        if (func_num_args() > 1) {
            $path = implode('/', func_get_args());
        }
        $path = preg_replace('/\/+/', '/', str_replace('\\', '/', $path));
        return $path;
    }

    /**
     * Get the view's rendering.
     *
     * @access private
     * @return buffer (the rendered view)
     */
    private function content()
    {
        if (! empty($this->viewVars)) {
            extract($this->viewVars);
        }

        ob_start();
        require_once $this->viewFile;
        return ob_get_clean();
    }

    /**
     * Add a view.
     *
     * @access private
     * @param  string  $view (the view name)
     */
    private function setView($view = '')
    {
        $viewPath = sprintf('%s/%s.php', $this->viewPath, $view);
        $viewFile = application_path($viewPath);
        $this->viewFile = $viewFile;

        if (is_file($this->viewFile) === false) {
            throw new Exception("The view file not exists in: {$viewFile}.");
        }
    }

    // end class...
}

/* End of file View.php */
/* Location: ./(<application folder>/libraries/<namespace>)/View.php */
