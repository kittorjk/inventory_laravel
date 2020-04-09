# create databases
CREATE DATABASE IF NOT EXISTS `homestead`;

# create root user and grant rights
CREATE USER 'homestead'@'%' IDENTIFIED BY 'homestead';


#GRANT ALL ON *.* TO 'root'@'%';
GRANT ALL ON homestead.* TO 'homestead'@'%';

FLUSH PRIVILEGES;
