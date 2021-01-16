<?php

namespace Simplisti\Lib\JasperStarter\Option;

class OptionAbstract
{

    /**
     * @var string Represents option value
     */
    private $value;

    public function getValue()
    {
        return $this->value;
    }

    protected function setValue($value)
    {
        $this->value = escapeshellarg($value);
        return $this;
    }

}
