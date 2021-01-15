<?php

namespace Simplisti\Lib\JasperStarter\Option;

use Simplisti\Lib\JasperStarter\Exception\HostUnreachableException;

class OptionDbHost extends OptionAbstract
{

    /**
     * constructor
     */
    public function __construct($host)
    {
        // Check the host IP quickly
        if ($host === gethostbyname($host)) {
            throw new HostUnreachableException("Host ($host) is unreachable or cannot resolve.");
        }

        $this->setValue($host);
    }

    /**
     * toString
     */
    public function __toString()
    {
        return "-H={$this->getValue()}";
    }

}
