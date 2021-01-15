<?php

namespace Simplisti\Lib\JasperStarter\Option;

class OptionDbPort extends OptionAbstract
{

    /**
     * constructor
     */
    public function __construct($port)
    {
        $this->setValue($port);
    }

    /**
     * toString
     */
    public function __toString()
    {
        return "--db-port={$this->getValue()}";
    }

}
