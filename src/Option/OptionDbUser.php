<?php

namespace Simplisti\Lib\JasperStarter;

class OptionDbUser
{

    /**
     * @var string Represents DB user name
     */
    private $user;

    /**
     * constructor
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * toString
     */
    public function __toString()
    {
        return "-u={$this->user}";
    }

}
