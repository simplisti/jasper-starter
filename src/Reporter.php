<?php

namespace Simplisti\Lib\JasperStarter;

use Symfony\Component\Process\ExecutableFinder;

use Simplisti\Lib\JasperStarter\Exception\JasperBinaryMissingException;
use Simplisti\Lib\JasperStarter\Exception\SourceFileMissingException;

class Reporter
{

    use CompileTrait;
    use ProcessTrait;

    /**
     * @var string JasperStarter binary path (auto-discovered or manually provided). JasperStarter must be added to $PATH for auto-discovery.
     */
    private $binaryPath = '';

    /**
     * @var array JasperStarter binary command output(s) and error(s) if any
     */
    private $binaryOutput = [];

    /**
     * Constructor
     *
     * @param string JasperStarter binary path (auto-discovered or manually provided). JasperStarter must be added to $PATH for auto-discovery.
     *
     * @throws JasperBinaryMissingException
     */
    public function __construct(?string $binaryPath = null)
    {
        if (null !== $binaryPath) { // Manually override the name/location of jasper binary
            if (!file_exists($binaryPath)) {
                throw new JasperBinaryMissingException("JasperStarter location ($binaryPath) could not be found. Verify it's existence and try again.");
            }

            $this->binaryPath = $binaryPath;
        } else {
            $executableFinder = new ExecutableFinder();
            $this->binaryPath = $executableFinder->find('jasperstarter');

            if (null === $this->binaryPath) {
                throw new JasperBinaryMissingException('JasperStarter (jasperstarter) could not be found. Make sure Jasper is added to $PATH, or provide a absolute path as a constructor argument.');
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
     * Validate the path/existence of a $sourceFile
     *
     * @throws SourceFileMissingException
     *
     * @return string An escaped string ready for use in command
     */

    private function validateSourceFile($sourceFile)
    {
        if (!file_exists($sourceFile)) {
            $moreHelp = '';
            if (file_exists(trim($sourceFile, '/'))) {
                $moreHelp = "Remove the leading slash from $sourceFile";
            }
            throw new SourceFileMissingException("Source file ($sourceFile) is missing or cannot be found. $moreHelp");
        }

        return escapeshellarg($sourceFile);
    }

}