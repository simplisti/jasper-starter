<?php

namespace Simplisti\Lib\JasperStarter;

class Report extends AbstractDs
{

    use ParamTrait;
    use OptionDbTrait;
    use OptionFileTrait;

    /**
     * @var array|null Template source file
     */
    private $sourceFile = '';

    /**
     * @var array|null Template target type
     */
    private $targetType = '';

    /**
     * Constructor
     */
    public function __construct (string $sourceFile, string $targetType = 'pdf')
    {
        $this->sourceFile = $sourceFile;
        $this->targetType = $targetType;
    }

    /**
     * Get the source template file 
     *  
     * @return string
     */
    public function getSourceFile ()
    {
        return $this->sourceFile;
    }

    /**
     * Get the target file type
     *  
     * @return string
     */
    public function getTargetType ()
    {
        return $this->targetType;
    }

}
