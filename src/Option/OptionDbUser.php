<?php

namespace Simplisti\Lib\JasperStarter\Option;

class OptionDbUser extends OptionAbstract
{

    /**
     * constructor
     */
    public function __construct($user)
    {
        $this->setValue($user);
    }

    /**
     * toString
     */
    public function __toString()
    {
        return "-u={$this->getValue()}";
    }

}
