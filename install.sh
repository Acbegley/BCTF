#!/bin/sh

sudo apt-get install apache2 -y
sudo apt-get install mysql-server -y
sudo apt-get install php libapache2-mod-php php-mcrypt php-mysql
sudo mv *  /var/www/html/
cd .. && sudo rm -r BCTF/
cd /var/www/html
sudo service mysql restart
sudo mysql -u root -p ctf < ctf.sql
sudo service apache2 restart
sudo rm ctf.sql
