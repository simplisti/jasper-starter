# PHP JasperStarter Library

Easier interfacing with JasperStarter command line tool. 

## Install 

```
	composer require "alex-barylski/jasper-starter": "dev-master"
```

## Install JasperStarter Binary

The JasperStarter command line tool does most of the heavy lifting so installing 
it is a required dependency.

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

# Best Practices

Don't perform most calculations in the template - instead calculate those values in your client or server code and persist the sub-totals and grand total in the DB.

# Alternatives

- https://packagist.org/packages/cossou/jasperphp
- https://packagist.org/packages/jasperphp/jasperphp

# ADDED
 - Decoupled report from starter to better SOA and OOD
   - Setting parameters globally and/or report specific less hackish and easier
 - Fixed minor issue with NULL parameters 
 - Dropped `verbose` switch support - redundant info
 - Clear single parameters using setParameter()
 - Added exceptions thrown when CLI errors
 - Added support for JDBC / Oracle (Un-tested)
 - Added support for CSV file data source
 
# TODO 
 - List printers and implement direct printer control
 - Added support for XML file data source
 - Added support for JSON file data source