<?php

namespace Simplisti\Lib\JasperStarter;

trait OptionFileTrait
{

    /**
     * @var string|null file name(ie: deliminators)
     */
    private $file = ''; // File name

    /**
     * @var array|null CSV details (ie: deliminators)
     */
    private $csv = [];  // CSV parameters

    /**
     * Get the file to be used for data source
     *  
     * @return string
     */

    public function getFile ()
    {
        return $this->file;
    }

    /**
     * Set the file to be used for data source
     *  
     * @return $this
     */
    public function setFile ($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get the CSV file details for data source or false on failure
     *  
     * @return string
     */
    public function getCsvfile ($key)
    {
        if (array_key_exists($key, $this->csv)) {
            return $this->csv[$key];
        }

        return false;
    }

    /**
     * Set the CSV file details for data source
     *  
     * @return $this
     */
    public function setCsvOptions ($charSet = 'utf-8', $delimField = ",", $delimNewLine = "\n", array $columnHeaderNames = [])
    {
        $this->csv['charSet'] = $charSet;
        $this->csv['delimField'] = $delimField;
        $this->csv['delimNewLine'] = $delimNewLine;

        $this->csv['columnHeaderNames'] = $columnHeaderNames;

        return $this;
    }

}
