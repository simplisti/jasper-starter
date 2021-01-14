<?php

namespace Simplisti\Lib\JasperStarter\Option;

use Simplisti\Lib\JasperStarter\Exception\HostUnreachableException;

class OptionDbHost
{

    /**
     * @var string Represents DB host
     */
    private $host;

    /**
     * constructor
     */
    public function __construct($host)
    {
        $this->host = $host;

        // Check the host IP quickly
        if ($host === gethostbyname($host)) {
            throw new HostUnreachableException("Host ($host) is unreachable or cannot resolve.");
        }
    }

    /**
     * toString
     */
    public function __toString()
    {
        return "-H={$this->host}";
    }

}
