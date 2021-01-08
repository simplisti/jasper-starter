# PHP JasperStarter Library

Easier interfacing with JasperStarter command line tool. 

## Install JasperStarter Binary

This JasperStarter library is simple an object-oriented wrapper for the JasperStarter
command line tool, therefore installing the JasperStarter binary is required.

```
	sed -i "s/jessie main/jessie main non-free contrib/g" /etc/apt/sources.list && apt-get update && apt-get -y install msttcorefonts

	cd /tmp
	wget https://sourceforge.net/projects/jasperstarter/files/JasperStarter-3.0/jasperstarter-3.0.0-bin.zip/download -O jasperstarter-3.0.0.zip
	unzip jasperstarter-3.0.0.zip
	mv jasperstarter /opt;
	cd /opt/jasperstarter/bin
	chmod 777 *

	apt-get install -y default-jre
	apt-get install cabextract
	apt-get install -y xfonts-utils
	apt-get -f -y install

	ln -s /opt/jasperstarter/jdbc/mysql.jar /usr/share/java/mysql.jar 
```

## Install JasperStarter Library via Composer

```
	composer require "simplisti/jasper-starter": "dev-master"
```

## Example

```
<?php
	require 'vendor/autoload.php';

	use Jasper\Starter;
	use Jasper\Report;

	try {
			$report = new Report('report_csv.jrxml', 'pdf');
			$report->setParameter('ID_WORKORDER', 99999);

			$jasper = new Starter('en_CA', 'assets', 'compiled');
			$jasper->setParameter('ID_ORGANIZATION', 762363);

			$jasper->compile($report);
			$outputPathPdf = $jasper->process($report1);

			//echo $jasper; // useful debugging

			file_put_contents('workorder-10128.pdf', file_get_contents($outputPathPdf));
	}
	catch (Exception $e) {
			echo $e->getMessage();
	}
```

## Configuring JasperStarter as a Symfony service

```
    # Configure the Jasper starter service
    Simplisti\Lib\JasperStarter\Starter:
        arguments:
            $locale: '%application.locale%'
            $sourcePath: '%application.path.jasper.source%'
            $compiledPath: 'compiled'          
            $optionalArguments:
                SOME_ID: '%application.id%'
        calls:
            - method: setDatasource
              arguments:
                - 'mysql'
            - method: setDatabaseUrl 
              arguments:
                $url: '%env(DATABASE_URL)%'
```
 
## TODO 
 - Implement Symfony bundle and display compilation/process errors in data collector
   - Find JasperStarter binary automagically?
   - cp and pr commands?
   - template generation from entity?
 - Implement Compiler/Processor class?
 - List printers and implement direct printer control
 - Add support for dynamic reports via compilation?
 - Add support for XML file data source
 - Add support for JSON file data source
 - Support for Windows?

## Alternatives

- https://packagist.org/packages/cossou/jasperphp
- https://packagist.org/packages/jasperphp/jasperphp
