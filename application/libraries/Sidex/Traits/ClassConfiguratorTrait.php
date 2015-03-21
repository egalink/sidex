<?php namespace Sidex\Traits;

use \ReflectionClass;

trait ClassConfiguratorTrait {

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

/* End of file ClassConfiguratorTrait.php */
/* Location: ./(<application folder>/libraries/<namespace>)/ClassConfiguratorTrait.php */
