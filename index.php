<?php

include_once 'vendor/autoload.php';

use Simplisti\Lib\JasperStarter\Reporter;

use Simplisti\Lib\JasperStarter\Option\OptionParameter as oParams;

use Simplisti\Lib\JasperStarter\Option\OptionDb as oDbConn;
use Simplisti\Lib\JasperStarter\Option\OptionOutputType as oOutputType;

// Use aggregate DB connection object
//$optionDb = new oDbConn('simplisti', 'root');

$options[] = new oOutputType('pdf');
$options = array_merge($options, (array)$optionDb);

$parameters = new oParams([
    'ID_ORGANIZATION' => 254,
    'ID_WORKORDER' => 112203
]);

$outputFile = '';

$reporter = new Reporter('/opt/jasperstarter/bin/jasperstarter'); // NOTE: Manually provide jasperstarter?!? Need PATH= otherwise
//$reporter->compile('tpl/cert.jrxml');
//$reporter->process('tpl/cert.jasper', $outputFile, $options, $parameters);

$parameters = [];
$reporter->listParameters('tpl/cert.jrxml', $parameters);

//echo $process->getCommandLine()."\n";