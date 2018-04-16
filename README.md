# cop4331-large

Using linux/OSX:
#1) open terminal

#2) run "chmod 400 /my/file/location/WebServer.pem" //this will make sure the .pem file is private

#3) ssh -i WebServer.pem ubuntu@ec2-34-201-255-155.compute-1.amazonaws.com

#You should be greeted to the server.  Ubuntu is the root user.  There is no password for the root user.

Windows:
Use the .ppk file on the master page and use PUTTY to access the server

#Notes:
#34.201.255.155 is the server IP
www.cop4331-group16.com is the server domain 


#MySQL Server:
#use this code to login: mysql -u root -p

#password:  password

#PHPMYADMIN (can be accessed in the browser)
 http://www.cop4331-group16.com/phpmyadmin/
login: root
password: password

#To access the sql server config file: sudo nano /etc/mysql/mysql.conf.d/mysqld.cnf

Webpage Index Directory by default is /var/www/html/

#Google PHP API
#https://developers.google.com/calendar/quickstart/php


#Github Notes:
#/git/testing will be the default git repo on the server

#Apache WebServer:

#directory for index files is /var/www/html
