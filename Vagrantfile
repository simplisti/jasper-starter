Vagrant.configure(2) do |config|
  config.vm.box = "debian/contrib-stretch64"
	
  config.vm.network :forwarded_port, guest: 8000, host: 8084
  config.vm.network :forwarded_port, guest: 3306, host: 33006

  config.vm.provider "virtualbox" do |v|
    v.memory = 256 
  end

  config.vm.provision "shell", inline: <<-SHELL
		export DEBIAN_FRONTEND="noninteractive"

		# Upgrade sources for PHP 7.1+
    apt-get -y install apt-transport-https lsb-release ca-certificates &&
		wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg &&
		echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list &&
		apt-get update

		# Install PHP 7.1+ (http://wiki.netbeans.org/HowToConfigureXDebug)
		apt-get -y install php7.1-cli curl unzip &&

		# Install composer package manager
		curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer 

		# Updates sources for mscore font usage required by JasperStarter when using Arial fonts
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

		# NOTE: Create symlink for JasperStarter to mysql ODBC jar file - installed above
		ln -s /opt/jasperstarter/jdbc/mysql.jar /usr/share/java/mysql.jar 
  SHELL

	config.vm.synced_folder ".", "/vagrant", type: "virtualbox"
end