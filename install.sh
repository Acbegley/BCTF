#!/bin/sh

sudo apt-get install apache2 -y
sudo apt-get install mysql-server -y
sudo apt-get install php libapache2-mod-php php-mcrypt php-mysql php-ldap
sudo mv *  /var/www/html/
cd .. && sudo rm -r BCTF/
cd /var/www/html
sudo service mysql restart
echo '


'
echo "You will need to enter your MySQL password a couple of times"
echo '


'
sudo mysql -u root -p -e "create database ctf"
sudo mysql -u root -p ctf < ctf.sql
sudo service apache2 restart
