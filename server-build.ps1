docker network create dairy --driver bridge

# Start a docker container for php and apache
docker run --rm --network dairy -dit -p 80:80 -v C:\Projects\Dairy\src:/var/www/html php:7.2-apache 

# Start a docker mysql container
docker run --rm --network dairy --name db -p 3306:3306 -v C:\Projects\Dairy\mysql:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=geheim -dit mysql:8 

