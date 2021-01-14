<?php

include_once '../vendor/autoload.php';

include_once 'src/Exception/HostUnreachableException.php';
include_once 'src/Exception/SourceFileMissingException.php';
include_once 'src/Exception/OutputUnrecognizedException.php';
include_once 'src/Exception/SchemeUnrecognizedException.php';
include_once 'src/Exception/JasperBinaryMissingException.php';


include_once 'src/Option/OptionOutputType.php';

include_once 'src/Option/OptionDbScheme.php';
include_once 'src/Option/OptionDbHost.php';
include_once 'src/Option/OptionDbName.php';
include_once 'src/Option/OptionDbUser.php';
include_once 'src/Option/OptionDbPass.php';
include_once 'src/Option/OptionDbPort.php';

$options[] = new \Simplisti\Lib\JasperStarter\OptionOutputType('pdf');

$options[] = new \Simplisti\Lib\JasperStarter\OptionDbScheme('mysql');
$options[] = new \Simplisti\Lib\JasperStarter\OptionDbHost('localhost');
$options[] = new \Simplisti\Lib\JasperStarter\OptionDbName('simplisti');
$options[] = new \Simplisti\Lib\JasperStarter\OptionDbUser('apps');
$options[] = new \Simplisti\Lib\JasperStarter\OptionDbPass('');
$options[] = new \Simplisti\Lib\JasperStarter\OptionDbPort(2306);

$outputFile = '';

$reporter = new Reporter();
$reporter->compile('tpl/test.jrxml');
$process = $reporter->process('tpl/test.jasper', $outputFile, $options);

echo $process->getCommandLine();

//
// Class implementation
//

