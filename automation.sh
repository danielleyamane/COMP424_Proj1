#! /bin/bash

#Install Apache
sudo apt-get update
sudo apt-get install apache2

#Check for syntax errors
sudo apache2ctl configtest

#Install MySQL
sudo apt-get install mysql-server
#Security script
sudo mysql_secure_installation
#Install db
sudo mysql_install_db

#Install PHP
sudo apt-get install php libapache2-mod-php php-mcrypt php-mysql
#Move index.php right after DirectoryIndex
sudo nano /etc/apache2/mods-enabled/dir.conf

#Restart Server
sudo systemctl restart apache2


#MySQL
mysql -u root -p 
#Create Database
CREATE DATABASE COMP424;

#Enter database
USE COMP424;

#Create table to store user info
CREATE TABLE user (
	userid int not null auto_increment primary key,
	username varchar(255),
	password varchar(255),
	firstname varchar(50),
	lastname varchar(50),
	birthdate DATE,
	email varchar(255),
	lastvisit DATETIME,
	active BOOL,
	firstQ int,
	firstA varchar(255),
	secondQ int,
	secondA varchar(255)
);