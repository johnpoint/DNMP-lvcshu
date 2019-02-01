#!/usr/bin/bash
url='https://center.lvcshu.com'
secret='123456'
ipv4=$(curl ip.sb)
curl ${url}'/api.php?do=get&ipv4='${ipv4}'&secret='${secret}
exit
#nginx
nginx=$(docker ps|grep nginx)
if [[ ! $nginx ]]; then
    echo "NULL"
else
    echo "ON"
fi
cat json |jq -r .info[0].nginx
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

