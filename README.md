# cop4331-large

#1) open terminal

#2) run "chmod 400 POOPGROUP.pem" //this will make sure the .pem file is private

#3) ssh -i POOPGROUP.pem ubuntu@ec2-18-188-148-0.us-east-2.compute.amazonaws.com 

#You should be greeted to the server.  Ubuntu is the root user.  There is no password for the root user.


#Notes:
#http://18.188.148.0 is the server IP


#MySQL Server:
#use this code to login: mysql -u root -p

#password:  password

#To access the sql server config file: sudo nano /etc/mysql/mysql.conf.d/mysqld.cnf

#PHP Notes:
#http://18.188.148.0/info.php is working.  Directory by default is /var/www/html/

#Google PHP API
#https://developers.google.com/calendar/quickstart/php


#Github Notes:
#/git/testing will be the default git repo on the server

#Apache WebServer:

#it is set to look for .php files first before anything
#directory for index files is /var/www/html
