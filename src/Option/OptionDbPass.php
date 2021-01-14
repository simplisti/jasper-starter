<?php

namespace Simplisti\Lib\JasperStarter;

class OptionDbPass
{

    /**
     * @var string Represents DB user password
     */
    private $pass;

    /**
     * constructor
     */
    public function __construct($pass)
    {
        $this->pass = $pass;
    }

    /**
     * toString
     */
    public function __toString()
    {
        return "-p={$this->pass}";
    }

}
