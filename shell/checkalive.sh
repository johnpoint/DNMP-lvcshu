#!/usr/bin/bash

#nginx
nginx=$(docker ps|grep nginx)
if [[ ! $nginx ]]; then
    echo "NULL"
else
    echo "ON"
fi

#php-fpm
phpfpm=$(docker ps|grep php-fpm)
if [[ ! $phpfpm ]]; then
    echo "NULL"
else
    echo "ON"
fi

#mysql
mysql=$(docker ps|grep mysql)
if [[ ! $mysql ]]; then
    echo "NULL"
else
    echo "ON"
fi

#proxy
proxy=$(docker ps|grep proxy)
if [[ ! $proxy ]]; then
    echo "NULL"
else
    echo "ON"
fi

