<?php

include_once '../vendor/autoload.php';

use Simplisti\Lib\JasperStarter\Option\OptionOutputType as oOutputType;
use Simplisti\Lib\JasperStarter\Option\OptionDbScheme as oDbScheme;

$options[] = new oOutputType('pdf');
$options[] = new oDbScheme('mysql');

//$options[] = new \Simplisti\Lib\JasperStarter\OptionOutputType('pdf');
//
//$options[] = new \Simplisti\Lib\JasperStarter\OptionDbScheme('mysql');
//$options[] = new \Simplisti\Lib\JasperStarter\OptionDbHost('localhost');
//$options[] = new \Simplisti\Lib\JasperStarter\OptionDbName('simplisti');
//$options[] = new \Simplisti\Lib\JasperStarter\OptionDbUser('apps');
//$options[] = new \Simplisti\Lib\JasperStarter\OptionDbPass('');
//$options[] = new \Simplisti\Lib\JasperStarter\OptionDbPort(2306);
//
//$outputFile = '';
//
//$reporter = new Reporter();
//$reporter->compile('tpl/test.jrxml');
//$process = $reporter->process('tpl/test.jasper', $outputFile, $options);
//
//echo $process->getCommandLine();

print_r($options);