<?php

namespace Simplisti\Lib\JasperStarter\Option;

class OptionDbPass extends OptionAbstract
{

    /**
     * constructor
     */
    public function __construct($pass)
    {
        $this->setValue($pass);
    }

    /**
     * toString
     */
    public function __toString()
    {
        return "-p={$this->getValue()}";
    }

}
