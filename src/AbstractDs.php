<?php

namespace Simplisti\Lib\JasperStarter;

abstract class AbstractDs
{

    /**
     * @var string|null Data source type (ie: mysql, csv, etc)
     */
    private $dataSourceType = '';

    /**
     * Get the data source type
     *  
     * @return string
     */
    public function getDataSource ()
    {
        return $this->dataSourceType;
    }

    /**
     * Set the data source type (ie: csv, xml, mysql, etc)
     *  
     * @return $this
     */
    public function setDataSource ($type = 'none')
    {
        $this->dataSourceType = $type;

        return $this;
    }

}
