docker network create dairy --driver bridge

echo "$PSScriptRoot"

# Start a docker container for php and apache
docker run --rm --network dairy -dit -p 80:80 -v $PSScriptRoot\src:/var/www/html php:7.2-apache 

# Start a docker mysql container
docker run --rm --network dairy --name db -p 3306:3306 -v $PSScriptRoot\mysql:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=geheim -dit mysql:8 

