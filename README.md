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

#Git repository on the webserver: 
/var/www/html

#MySQL Server:
#use this code to login: mysql -u root -p
#password:  password

#PHPMYADMIN (can be accessed in the browser)
 http://www.cop4331-group16.com/phpmyadmin/
login: root
password: password

#To access the sql server config file: sudo nano /etc/mysql/mysql.conf.d/mysqld.cnf

Webpage Index Directory by default is /var/www/html/cop4331-large/public_html

#Github Notes:
Navicate to /var/www/html/cop4331-large and use "git pull".  This is where the .git file is located so it has the server info ready to go.

#Apache WebServer:
login: root
password: password

#directory for index files is /var/www/html/cop4331-large/public_html. This is assigned through Apache Server.



