<?php

namespace Simplisti\Lib\JasperStarter;

class Starter extends AbstractDs
{

    use ParamTrait;
    use OptionDbTrait;

    /**
     * @var string|null Executable path (JasperStarter) 
     */
    private $executablePath = '';

    /**
     * @var string|null Processed reports directory
     */
    private $processedPath = '';

    /**
     * @var string|null Compiled reports directory
     */
    private $compiledPath = '';

    /**
     * @var string|null Source reports directory
     */
    private $sourcePath = '';

    /**
     * @var string|null Executable shell command 
     */
    private $shellCommand = '';

    /**
     * Constructor
     * 
     * $locale 
     * $sourcePath is relative to the script which invokes Jasper PHP 
     * $compiledPath is relative to the source path
     * $exeuctablePath is absolute path to the jasperstarter binary
     * 
     */
    public function __construct (string $locale, $sourcePath, string $compiledPath = '', string $processedPath = '', string $executablePath = '/opt/jasperstarter/bin/jasperstarter')
    {
        $this->setDataSource();

        $systemTempPath = sys_get_temp_dir();

        $this->sourcePath = $sourcePath;
        $this->compiledPath = empty($compiledPath) ? $sourcePath : $compiledPath;
        $this->processedPath = empty($processedPath) ? $systemTempPath : $processedPath;

        $this->executablePath = $executablePath . " --locale $locale";
    }

    /**
     * toString
     */
    public function __toString ()
    {
        return $this->shellCommand;
    }

    /**
     * Compile JRXML files into JASPER for processing. 
     * 
     * @return self
     */
    public function compile (Report $report, bool $skipExec = false)
    {

        $sourceFullPath = $report->getSourceFile(); // $this->sourcePath . DIRECTORY_SEPARATOR . $report->getSourceFile(); 
        $compiledPath = $this->compiledPath;

        $this->shellCommand = $this->executablePath . " cp -o $compiledPath $sourceFullPath";

        if (!$skipExec) {
            $oldcwd = getcwd();
            chdir($this->sourcePath);
            $error = shell_exec(escapeshellcmd($this->shellCommand));
            chdir($oldcwd);

            if (!empty($error)) {
                throw new \Exception($error);
            }
        }

        return $compiledPath;
    }

    /**
     * Process JASPER file into PDF or similar output format.
     *  
     * @return $this
     */
    public function process (Report $report, bool $skipExec = false)
    {
        $compiledFullPath = $this->compiledPath . DIRECTORY_SEPARATOR . pathinfo($report->getSourceFile(), PATHINFO_FILENAME) . '.jasper';
        $processedFullPath = $this->processedPath . DIRECTORY_SEPARATOR . uniqid('ASB');

        $format = ' -f ' . $report->getTargetType();

        $value = empty($report->getDataSource()) ? $this->getDataSource() : $report->getDataSource();
        $type = "-t $value ";

        $datafile = '';
        if (!empty($report->getFile('file'))) {
            $datafile .= $this->processCsvFileOptions($report);
        }

        $database = $this->processDatabaseOptions($report);
        $parameters = $this->processReportParameters($report);

        $this->shellCommand = $this->executablePath . " pr -o $processedFullPath $compiledFullPath $format $type $database $datafile $parameters";

        if (!$skipExec) {
            $oldcwd = getcwd();
            chdir($this->sourcePath);
            $error = shell_exec(escapeshellcmd($this->shellCommand));
            chdir($oldcwd);

            if (!empty($error)) {
                throw new \Exception($error);
            }
        }

        return $processedFullPath . '.' . $report->getTargetType();
    }

    /**
     * Process CSV file details
     *  
     * @return $this
     */
    protected function processCsvFileOptions (Report $report)
    {
        $value = $report->getFile('file');
        $csvSwitch = "--data-file $value ";

        // NOTE: If column headers array is empty than we assume CSV first row
        $value = $report->getCsvfile('columnHeaderNames');
        if (empty($value)) {
            $csvSwitch .= '--csv-first-row ';
        }
        else {
            $csvSwitch .= "--csv-columns " . implode(',', $value) . ' ';
        }

        $value = $report->getCsvfile('charSet');
        $database = "--csv-charset $value ";

        $value = $report->getCsvfile('delimField');
        $database = "--csv-field-del $value ";

        $value = $report->getCsvfile('delimNewLine');
        $database = "--csv-record-del $value ";

        return $csvSwitch;
    }

    /**
     * Process RDBMS file details (ie: mysql, etc)
     *  
     * @return $this
     */
    protected function processDatabaseOptions (Report $report)
    {
        // NOTE: Check whether database connection details have been set
        if (false === $this->getDatabase('name') || false === $report->getDatabase('name')) {
            return '';
        }

        // NOTE: Initialize $value for each command option testing the individual 
        //       report values for emptiness and defaulting to controlling object
        $value = empty($report->getDatabase('host')) ? $this->getDatabase('host') : $report->getDatabase('host');
        $database = "-H $value ";

        $value = empty($report->getDatabase('user')) ? $this->getDatabase('user') : $report->getDatabase('user');
        $database .= "-u $value ";

        $value = empty($report->getDatabase('pass')) ? $this->getDatabase('pass') : $report->getDatabase('pass');
        $database .= "-p $value ";

        $value = empty($report->getDatabase('name')) ? $this->getDatabase('name') : $report->getDatabase('name');
        $database .= "-n $value ";

        $value = empty($report->getDatabase('port')) ? $this->getDatabase('port') : $report->getDatabase('port');
        $database .= "--db-port $value ";

        // JDBC options
        $value = empty($report->getDatabase('url')) ? $this->getDatabase('url') : $report->getDatabase('url');
        $database .= "--db-url $value";

        $value = empty($report->getDatabase('dir')) ? $this->getDatabase('dir') : $report->getDatabase('dir');
        $database .= "--jdbc-dir $value";

        $value = empty($report->getDatabase('class')) ? $this->getDatabase('class') : $report->getDatabase('class');
        $database .= "--db-driver $value";

        // Oracle SID
        $value = empty($report->getDatabase('sid')) ? $this->getDatabase('sid') : $report->getDatabase('sid');
        $database .= "--db-sid $value";

        return $database;
    }

    /**
     * Process parameters 
     *  
     * @return $this
     */
    protected function processReportParameters (Report $report)
    {
        // NOTE: Remove parameters which have NULL values, etc
        $globalParameters = $this->resetEmptyParameters();
        $reportParameters = $report->resetEmptyParameters();

        // NOTE: Report parameters will over-write the global Starter parameters
        $mergedParameters = array_merge($globalParameters, $reportParameters);

        $parameters = '';
        if (!empty($mergedParameters)) {
            $parameters = '-P ';
            foreach ($mergedParameters as $name => $value) {
                $value = is_numeric($value) ? $value : "'$value'";
                $parameters .= "$name=$value ";
            }
        }

        return $parameters;
    }

}
