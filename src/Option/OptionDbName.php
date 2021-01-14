<?php

namespace Simplisti\Lib\JasperStarter\Option;

class OptionDbName
{

    /**
     * @var string Represents DB name
     */
    private $name;

    /**
     * constructor
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * toString
     */
    public function __toString()
    {
        return "-n={$this->name}";
    }

}
