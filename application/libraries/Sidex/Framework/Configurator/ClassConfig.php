<?php namespace Sidex\Framework\Configurator;

class ClassConfig {

    /**
     * Takes an array of values to set as configuration attributes.
     *
     * @access protected
     * @param  array  $options (the array of values)
     */
    protected function configure(array $options)
    {
        foreach ($options as $key => $val) $this->set($key, $val);
    }

    /**
     * Set a value as configuration attribute.
     *
     * @access protected
     * @param  string $attribute (the attribute name)
     * @param  mixed  $value
     */
    protected function set($attribute, $value)
    {
        if (isset($this->{$attribute}) === true) $this->{$attribute} = $value;
    }

    // end class...
}

/* End of file ClassConfig.php */
/* Location: ./(<application folder>/libraries/<namespace>)/ClassConfig.php */
