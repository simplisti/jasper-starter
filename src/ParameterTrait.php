<?php

namespace Simplisti\Lib\JasperStarter;

use Symfony\Component\Process\Process;

trait ParameterTrait
{

    /**
     * List parameters in template source file
     *
     * @param string $sourceFile JRXML source file (relative or absolute path)
     *
     * @return Process An instance of the Process class used to generate compiled output
     */

    public function listParameters(string $sourceFile, array &$parameters): Process
    {
        $this->validateSourceFile($sourceFile);

        $command = [$this->binaryPath, 'list_parameters', $sourceFile];

        $process = new Process($command);
        $process->run();

        $lines = array_filter(explode("\n", $process->getOutput()));

        foreach ($lines as $line) {
            list($prompt, $param, $type) = array_values(array_filter(explode(' ', $line)));
            $parameters[$param] = [$type => $prompt];
        }

        return $process; // The process handling compilation
    }

}