# Jasper Starter

JasperPHP: Easier interfacing with JasperStarter command line tool. 

# Installation

Installing JasperStarter should be simple following these steps:

` 
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
`

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