#/bin/bash

apt-get update

apt-get install -y apache2 ansible

#Haciendo el artisan de los seeder
cd /var/www/
php artisan db:seed
