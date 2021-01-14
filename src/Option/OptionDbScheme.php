<?php

namespace Simplisti\Lib\JasperStarter\Option;

use Simplisti\Lib\JasperStarter\Exception\SchemeUnrecognizedException;

class OptionDbScheme
{

    /**
     * @var string Represents DB scheme
     */
    private $scheme;

    /**
     * constructor
     */
    public function __construct($scheme)
    {
        $allowed = ['none', 'csv', 'xml', 'json', 'jsonql', 'mysql', 'postgres', 'oracle', 'generic'];
        if(!in_array($scheme, $allowed)) {
            throw new SchemeUnrecognizedException("Scheme ($scheme) is not recognized. Must be one of the following: ".explode(',', $allowed));
        }

        $this->scheme = $scheme;
    }

    /**
     * toString
     */
    public function __toString()
    {
        return "-t={$this->scheme}";
    }

}
