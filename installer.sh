#!/bin/bash

#
# Installation Script for CS Website
#
# INSTRUCTIONS: Instructions for this file can be found on the base readme file
# REQUIREMENTS: CENTOS 7 x86
# NOTE: Permissions for this file need to be set at 755 to execute this script.



echo "Installing Web Server and Database"
#Installs the webserver and database packages as well as php
sudo yum install -y httpd mariadb-server php php-mysql git
echo "Starting Services..."
#Starts the installed services
sudo systemctl start httpd
sudo systemctl start mariadb.service
#Enables the services at boot
sudo systemctl enable httpd
sudo systemctl enable mariadb.service
echo "Configuring Firewall..."
#Configuration of Firewall
sudo firewall-cmd --zone=public --add-service=http
#Installing Files from git repository
cd /var/www/html/
echo "Installing Files..."
sudo git init
sudo git pull https://github.com/franknavarro/BiolaCSCI.git master
#Configuration of Mysql
echo "Configuring Mysql Server"
sudo mysql_secure_installation
echo "Installing Database..."
#Obtains the root password in order to allow for installation of base database
echo "Please enter mysql server root password (The one that you created/entered above)"
read -s mysqlRoot
sudo mysql -u "root" -p$mysqlRoot < /var/www/html/resources/db/generate_db.sql
echo "Complete: CS Site has been fully installed"
echo "Installed:"
echo "Active - Web Server"
echo "Active - DB Server"
echo "Complete - Configured Firewall"
echo "Complete - Placed CSCI Web application files in /var/www/html/"
echo "Web Directory (Source Code): /var/www/html/"
echo "Navigate using cd /var/www/html"
