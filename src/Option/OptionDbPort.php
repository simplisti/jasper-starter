<?php

namespace Simplisti\Lib\JasperStarter\Option;

class OptionDbPort
{

    /**
     * @var string Represents DB port
     */
    private $port;

    /**
     * constructor
     */
    public function __construct($port)
    {
        $this->port = $port;
    }

    /**
     * toString
     */
    public function __toString()
    {
        return "--db-port={$this->port}";
    }

}
