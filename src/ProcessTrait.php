<?php

namespace Simplisti\Lib\JasperStarter;

use Symfony\Component\Process\Process;

use Simplisti\Lib\JasperStarter\Option\OptionParameter;
use Simplisti\Lib\JasperStarter\Option\OptionOutputType as oType;

trait ProcessTrait
{

    /**
     * Process template from source
     *
     * @param string $sourceFile JRXML source file (relative or absolute path)
     * @param string &$outputFile Temporary file for the resulting output
     * @param array $options Command options
     * @param OptionParameter $parameters Command parameters
     *
     * @return Process An instance of the Process class used to generate compiled output
     */

    public function process(string $sourceFile, string &$outputFile, ?array $options = [], ?OptionParameter $parameters = null): Process
    {
        $sourceFile = $this->validateSourceFile($sourceFile);

        // NOTE: Convert each Option object to a string for switch interpolation
        $fileExtension = '.pdf';
        $options = array_map(function ($item) use ($fileExtension) {
            if ($item instanceof oType) {
                $fileExtension = '.' . $item->getValue();
            }
            return (string)$item;
        }, $options);
        $options = implode(' ', $options);

        $outputFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . bin2hex(random_bytes(12));

        $binaryPath = escapeshellarg($this->binaryPath);
        $process = Process::fromShellCommandline("$binaryPath -v pr -o=$outputFile $sourceFile $options $parameters");

        $process->start();
        $process->wait(); // Make the process blocking

        $outputFile .= $fileExtension;

        return $process; // The process handling processing
    }

}