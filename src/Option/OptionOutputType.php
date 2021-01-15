<?php

namespace Simplisti\Lib\JasperStarter\Option;

use Simplisti\Lib\JasperStarter\Exception\OutputUnrecognizedException;

class OptionOutputType extends OptionAbstract
{

    /**
     * constructor
     */
    public function __construct($type)
    {
        $allowed = [
            'view', 'print', 'pdf', 'rtf', 'xls', 'xlsMeta',
            'xlsx', 'docx', 'odt', 'ods', 'pptx', 'csv',
            'csvMeta', 'html', 'xhtml', 'xml', 'jrprint'
        ];

        if (!in_array($type, $allowed)) {
            throw new OutputUnrecognizedException("File output type ($type) is not recognized. Must be one of the following: " . explode(',', $allowed));
        }

        $this->setValue($type);
    }

    /**
     * toString
     */
    public function __toString()
    {
        return "-f={$this->getValue()}";
    }

}
