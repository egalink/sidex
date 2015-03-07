<?php namespace Sidex;

/*
 * ----------------------------------------------------------------------------
 * THE SIDEX CLASS LOADER (PSR-0)
 * ----------------------------------------------------------------------------
 *
 * The following describes the mandatory requirements that must be adhered to
 * for autoloader interoperability:
 *
 * 1.- A fully-qualified namespace and class must have the following structure:
 *     \<Vendor Name>\(<Namespace>\)*<Class Name>
 *
 * 2.- Each namespace must have a top-level namespace ("Vendor Name").
 *
 * 3.- Each namespace can have as many sub-namespaces as it wishes.
 *
 * 4.- Each namespace separator is converted to a DIRECTORY_SEPARATOR when
 *     loading from the file system.
 *
 * 5.- Each _ character in the CLASS NAME is converted to a DIRECTORY_SEPARATOR.
 *     The _ character has no special meaning in the namespace.
 *
 * 6.- The fully-qualified namespace and class is suffixed with .php when
 *     loading from the file system.
 *
 * 7.- Alphabetic characters in vendor names, namespaces, and class names may be
 *     of any combination of lower case and upper case.
 *
 * ----------------------------------------------------------------------------
 * For more information: http://www.php-fig.org/psr/psr-0
 *
 */
class ClassLoader {

    /**
     * Indicates if a ClassLoader has been registered.
     *
     * @var bool
     */
    protected $registered = false;

    /**
     * The registered paths.
     *
     * @var array
     */
    protected $paths = array();

    /**
     * The array of class aliases.
     *
     * @var array
     */
    protected $aliases = array();

    /**
     * The class constructor.
     *
     * @param  array  $config
     */
    public function __construct(array $config = array())
    {
        $this->configure($config);
    }

    /**
     * Register the given class loader on the auto-loader stack.
     *
     * @return void
     */
    public function register()
    {
        if ($this->registered === false) {
            $this->registered = spl_autoload_register(['\Sidex\ClassLoader', 'load']);
        }
    }

    /**
     * Load the given class file.
     *
     * @param  string  $className
     * @return void
     */
    public function load($className)
    {
        if ($this->isClassAlias($className) === true) {
            return;
        }

        $fileName = $this->normalizeClass($className);

        foreach($this->paths as $path) {
            if (is_file(
                $realPath = $this->normalizePath($path, $fileName)) === true) {
                $fileName = $realPath;
            }
        }

        require_once $fileName;
    }

    /**
     * Configure the class loader.
     *
     * @access protected
     * @param  array  $config
     * @return $this
     */
    protected function configure(array $config)
    {
        foreach($config as $key => $value) {
            $this->setConfig($key, $value);
        }
        return $this;
    }

    /**
     * Set a given configuration value.
     *
     * @access protected
     * @param  string  $key
     * @param  mixed   $value
     * @return void
     */
    protected function setConfig($key, $value = null)
    {
        if (isset($this->{$key}) === true) {
            $this->{$key} = $value;
        }
    }

    /**
     * Implementing the lazy class loading.
     *
     * @access protected
     * @param  string  $className
     * @return boolean
     */
    protected function isClassAlias($className)
    {
        $isAlias = in_array($className, array_keys($this->aliases));

        if ($isAlias) {
            $alias = array_flip([$className]);
            $class = array_intersect_key($this->aliases, $alias);
            class_alias($class[$className], $className);
        }

        return $isAlias;
    }

    /**
     * Get the normal file name for a class.
     *
     * @access protected
     * @param  string  $className
     * @return string
     */
    protected function normalizeClass($className)
    {
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        $separator = DIRECTORY_SEPARATOR;

        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos +1);
            $fileName  = str_replace('\\', $separator, $namespace) . $separator;
        }

        $fileName .= str_replace('_', $separator, $className) . '.php';
        return $fileName;
    }

    /**
     * Builds a file path with the appropriate directory separator.
     *
     * @access protected
     * @param  string  $path
     * @return string
     */
    protected function normalizePath($path = '')
    {
        if (func_num_args() > 1) {
            $path = implode('/', func_get_args());
        }

        $path = str_replace('\\','/', $path);
        $path = preg_replace('/\/+/', DIRECTORY_SEPARATOR, $path);
        return $path;
    }

    // end class...
}

/* End of file ClassLoader.php */
/* Location: ./(<application folder>/libraries/<namespace>)/ClassLoader.php */
