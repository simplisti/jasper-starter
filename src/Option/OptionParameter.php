<?php

namespace Simplisti\Lib\JasperStarter\Option;

class OptionParameter
{

    private $params;

    /**
     * constructor
     */
    public function __construct(?array $params = null)
    {
        $this->params = $params;
    }

    public function has($name)
    {

    }

    public function add($name, $value)
    {

    }

    public function set($name, $value)
    {
        // TODO: null value will clear result
    }

    /**
     * toString
     */
    public function __toString()
    {
        $paramStr = '';
        foreach ($this->params as $name => $value) {
            $value = escapeshellarg($value);
            $paramStr = "$paramStr $name=$value";
        }

        return "-P$paramStr";
    }

}
