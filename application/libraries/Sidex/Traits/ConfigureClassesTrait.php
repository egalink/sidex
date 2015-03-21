<?php namespace Sidex\Traits;

use \ReflectionClass;

trait ConfigureClassesTrait {

    /**
     * Configure the given class with array of values.
     *
     * @access public
     * @param  object $object
     * @param  array  $config
     */
    public function configureClass(&$object, array $config)
    {
        $rclass = new ReflectionClass($object);
        foreach($config as $key => $value) {
            if ($rclass->hasProperty($key) === true)
                $object->{$key} = $value;
        }
    }

    // end trait...
}

/* End of file ConfigureClassesTrait.php */
/* Location: ./(<application folder>/libraries/<namespace>)/ConfigureClassesTrait.php */
