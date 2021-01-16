<?php

namespace Simplisti\Lib\JasperStarter\Option;

class OptionDb
{

    /**
     * constructor
     */
    public function __construct(string $name, string $user, string $pass = null, string $host = 'localhost', string $scheme = 'mysql', int $port = 3306)
    {
        // TODO: Implement construction as array or string - which requires parsing
        // TODO: Validate required minimum options???
        $this->scheme = new OptionDbScheme($scheme);
        $this->host = new OptionDbHost($host);
        $this->name = new OptionDbName($name);
        $this->user = new OptionDbUser($user);
        $this->pass = new OptionDbPass($pass);
        //$this->port = new OptionDbPort($port);
    }

}
