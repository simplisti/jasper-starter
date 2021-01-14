<?php

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ExecutableFinder;

class Reporter
{
    /**
     * @var string JasperStarter binary path
     */
    private $binaryPath = '';

    /**
     * @var string  JasperStarter binary command output
     */
    private $binaryOutput = [];

    /**
     * Constructor
     */
    public function __construct(?string $binaryPath = null)
    {
        if (null !== $binaryPath) { // Manually override the name/location of jasper binary
            if (!file_exists($binaryPath)) {
                throw new JasperBinaryMissingException("JasperStarter location ($binaryPath) could not be found. Pleases verify it's existence and try again.");
            }

            $this->binaryPath = $binaryPath;
        } else {
            $executableFinder = new ExecutableFinder();
            $this->binaryPath = $executableFinder->find('jasperstarter');

            if (null === $this->binaryPath) {
                throw new JasperBinaryMissingException('JasperStarter (jasperstarter) could not be found. Pleases provide a location as a constructor argument.');
            }
        }
    }

    /**
     * Get output/errors from jasperstarter command
     *
     * @return array An array of errors or outputs
     */
    public function getOutput()
    {
        return $this->binaryOutput;
    }

    /**
     * Compile template(s) from source
     *
     * @param string $sourceFile
     *
     * @return Process An instance of the Process class used to generate compiled output
     */

    public function compile(string $sourceFile): Process
    {
        $this->validateSourceFile($sourceFile);

        $command = [$this->binaryPath, '-v', 'cp', $sourceFile];

        $process = new Process($command);
        $process->start();
        $process->wait(); // Make the process blocking

        // NOTE: JasperStarter binary sends all output to stderr (not stdout?)
        $this->binaryOutput[] = $process->getErrorOutput();

        return $process; // The process handling compilation
    }

    /**
     * Process template(s) from jasper file
     *
     * @param string $sourceFile
     *
     * @return int binary command exit code via $process->run()
     */

    public function process(string $sourceFile, string &$outputFile, ?array $options = []): Process
    {
        $this->validateSourceFile($sourceFile);

        // NOTE: Convert each Option object to a string for switch interpolation
        $options = array_map(function ($item) {
            return (string)$item;
        }, $options);

        $outputFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . bin2hex(random_bytes(12));
        $command = [$this->binaryPath, '-v', 'pr', "-o=$outputFile", $sourceFile];
        $command = array_merge($command, $options);

        $process = new Process($command);
        $process->start();
        $process->wait(); // Make the process blocking

        // TDOO: We need to figure out how to determine the "type" from Options switches above
        $outputFile .= '.pdf';

        return $process; // The process handling processing
    }

    private function validateSourceFile($sourceFile)
    {
        if (!file_exists($sourceFile)) {
            $moreHelp = '';
            if (file_exists(trim($sourceFile, '/'))) {
                $moreHelp = "Remove the leading slash from $sourceFile";
            }
            throw new SourceFileMissingException("Source file ($sourceFile) is missing or cannot be found. $moreHelp");
        }
    }

}