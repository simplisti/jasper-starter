<?php

namespace Simplisti\Lib\JasperStarter;

use Symfony\Component\Process\Process;

trait CompileTrait
{

    /**
     * Compile template(s) from source
     *
     * @param string $sourceFile JRXML source file (relative or absolute path)
     *
     * @return Process An instance of the Process class used to generate compiled output
     */

    public function compile(string $sourceFile): Process
    {
        $this->validateSourceFile($sourceFile);

        $command = [$this->binaryPath, '-v', 'cp', $sourceFile];

        $process = new Process($command);
        $process->run();

        // NOTE: JasperStarter binary sends all output to stderr (not stdout?)
        $this->binaryOutput[] = $process->getErrorOutput();
        $this->binaryOutput[] = $process->getOutput();

        return $process; // The process handling compilation
    }

}