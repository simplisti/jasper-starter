<?php

require 'vendor/autoload.php';

use Jasper\Starter;
use Jasper\Report;

try {
    $report1 = new Report('report_csv.jrxml', 'pdf');
    $report1->setDataSource('csv');
    $report1->setFile('test.csv');
    //$report1->setCsvOptions();
    //
      //$report1->setParameter('CUSTOMER_ID', 992);
    //$report1->setParameter('ID_WORKORDER', 99999);

    $jasper = new Starter('en_CA', 'assets', 'compiled');
    //$jasper->setParameter('ID_WORKORDER', 762363);

    $jasper->compile($report1);
    $outputPathPdf = $jasper->process($report1);

    //echo $jasper;

    file_put_contents('workorder-10128.pdf', file_get_contents($outputPathPdf));
}
catch (Exception $e) {
    echo $e->getMessage();
}