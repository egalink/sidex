<?php  if ( ! defined('APPATH')) exit('No direct script access allowed.');


/*
 *-----------------------------------------------------------------------------
 * REGISTER THE COMPOSER AUTO LOADER
 *-----------------------------------------------------------------------------
 *
 * Composer provides a convenient, automatically generated class loader for our
 * application. We'll require it into the script here so that we do not have to
 * worry about the loading of any our classes manually.
 *
 * We just need to utilize it!
 *
 */

if (file_exists($composerAutoload = APPATH . 'vendor/autoload.php')) {
    require $composerAutoload;
}


/*
 * ----------------------------------------------------------------------------
 * THE SIDEX AUTO LOADER
 * ----------------------------------------------------------------------------
 *
 * We register an auto-loader "behind" the Composer loader that can load classes
 * on the fly, even if the autoload files have not been regenerated for the
 * application. We'll add it to the stack here.
 *
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

spl_autoload_register(function($className)
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

    foreach (require application_path('config/autoload.php') as $path) {
        $realPath = build_path($path, $fileName);
        if (is_file($realPath) === true) {
            $fileName = $realPath;
        }
    }

    require_once $fileName;
});

/* End of file autoload.php */
/* Location: ./(<application folder>/)bootstrap/autoload.php */

