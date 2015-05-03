<?php namespace Sidex\Framework\Response;

<<<<<<< HEAD
use Exception,
    InvalidArgumentException;
=======
use Exception;
>>>>>>> e1ecc90ae7c36c1aa6cfa64fed4d543cce1673a9

class View {

    const VIEW_FOLDER = 'views';

    private $viewFile;
    private $viewVars = array();
    private $viewPath = self::VIEW_FOLDER;

    /**
     * View class constructor.
     *
<<<<<<< HEAD
     * @param  string $view (the view name)
=======
     * @param  string $view (the view name.)
>>>>>>> e1ecc90ae7c36c1aa6cfa64fed4d543cce1673a9
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
<<<<<<< HEAD
     * @param  string  $view (empty string)
     * @return Sidex\Framework\Response\View Object
=======
     * @param  string  $view (empty string.)
     * @return Sidex\Http\Response\View Object
>>>>>>> e1ecc90ae7c36c1aa6cfa64fed4d543cce1673a9
     */
    public function make($view = '')
    {
        if (is_string($view) and $view != '') {
            $this->setView($view);
<<<<<<< HEAD
        } else {
            throw new InvalidArgumentException("The view name is not set correctly.");
        }
=======
        } else throw new Exception("The view name is not set correctly.");
>>>>>>> e1ecc90ae7c36c1aa6cfa64fed4d543cce1673a9

        return $this;
    }

    /**
     * Add a piece of data to the view.
     *
<<<<<<< HEAD
     * @param  string  $name  (the variable name)
     * @param  mixed   $value (default null)
     * @return Sidex\Framework\Response\View Object
=======
     * @param  string  $name  (the variable name.)
     * @param  mixed   $value (default null.)
     * @return Sidex\Http\Response\View Object
>>>>>>> e1ecc90ae7c36c1aa6cfa64fed4d543cce1673a9
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
     * Get the view's rendering.
     *
     * @access private
<<<<<<< HEAD
     * @return buffer (the rendered view)
=======
     * @return buffer (the rendered view.)
>>>>>>> e1ecc90ae7c36c1aa6cfa64fed4d543cce1673a9
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
<<<<<<< HEAD
     * @param  string  $view (the view name)
     */
    private function setView($view = '')
    {
        $viewPath = sprintf('%s/%s.php', $this->viewPath, $view);
        $viewFile = application_path($viewPath);
=======
     * @param  string  $view (the view name.)
     * @return void
     */
    private function setView($view = '')
    {
        $viewPath = sprintf("%s/%s.php", APPATH . $this->viewPath, $view);
        $viewFile = $this->normalizePath($viewPath);
>>>>>>> e1ecc90ae7c36c1aa6cfa64fed4d543cce1673a9
        $this->viewFile = $viewFile;

        if (is_file($this->viewFile) === false) {
            throw new Exception("The view file not exists in: {$viewFile}.");
        }
    }

<<<<<<< HEAD
=======
    /**
     * Builds a file path with the appropriate directory separator.
     *
     * @access private
     * @param  string
     * @return string path
     */
    private function normalizePath($path = '')
    {
        return normalize_path($path);
    }

>>>>>>> e1ecc90ae7c36c1aa6cfa64fed4d543cce1673a9
    // end class...
}

/* End of file View.php */
/* Location: ./(<application folder>/libraries/<namespace>)/View.php */
