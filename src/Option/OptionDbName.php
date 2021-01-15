<?php

namespace Simplisti\Lib\JasperStarter\Option;

class OptionDbName extends OptionAbstract
{

    /**
     * constructor
     */
    public function __construct($name)
    {
        $this->setValue($name);
    }

    /**
     * toString
     */
    public function __toString()
    {
        return "-n={$this->getValue()}";
    }

}
