#!/usr/bin/bash
url=''
secret=''
ipv4=$(curl ip.sb)
curl ${url}'/api.php?do=get&ipv4='${ipv4}'&secret='${secret} > data.json
exit
#nginx
nginxCENT=`cat data.json |jq -r .info[0].nginx`
nginx=$(docker ps|grep nginx)
if [[ ! $nginx ]]; then
    if [[ ${nginxCENT} == '1' ]]; then
        curl ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=nginx&value=0'
    else
        echo '0error'
    fi
else
    if [[ ${nginxCENT} == '0' ]]; then
        curl ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=nginx&value=1'
    else
        echo '0error'
    fi
fi

if [[ ${nginxCENT} == '11' ]]; then
    docker start nginx
    curl ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=nginx&value=1'
else if [[ ${nginxCENT} == '10' ]]; then
    docker stop nginx
    curl ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=nginx&value=0'
fi

#phpfpm
phpfpmCENT=`cat data.json |jq -r .info[0].phpfpm`
phpfpm=$(docker ps|grep phpfpm)
if [[ ! $phpfpm ]]; then
    if [[ ${phpfpmCENT} == '1' ]]; then
        curl ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=phpfpm&value=0'
    else
        echo '0error'
    fi
else
    if [[ ${phpfpmCENT} == '0' ]]; then
        curl ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=phpfpm&value=1'
    else
        echo '0error'
    fi
fi

if [[ ${phpfpmCENT} == '11' ]]; then
    docker start phpfpm
    curl ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=phpfpm&value=1'
else if [[ ${phpfpmCENT} == '10' ]]; then
    docker stop phpfpm
    curl ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=phpfpm&value=0'
fi

#mysql
mysqlCENT=`cat data.json |jq -r .info[0].mysql`
mysql=$(docker ps|grep mysql)
if [[ ! $mysql ]]; then
    if [[ ${mysqlCENT} == '1' ]]; then
        curl ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=mysql&value=0'
    else
        echo '0error'
    fi
else
    if [[ ${mysqlCENT} == '0' ]]; then
        curl ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=mysql&value=1'
    else
        echo '0error'
    fi
fi

if [[ ${mysqlCENT} == '11' ]]; then
    docker start mysql
    curl ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=mysql&value=1'
else if [[ ${mysqlCENT} == '10' ]]; then
    docker stop mysql
    curl ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=mysql&value=0'
fi

#proxy
proxyCENT=`cat data.json |jq -r .info[0].proxy`
proxy=$(docker ps|grep proxy)
if [[ ! $proxy ]]; then
    if [[ ${proxyCENT} == '1' ]]; then
        curl ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=proxy&value=0'
    else
        echo '0error'
    fi
else
    if [[ ${proxyCENT} == '0' ]]; then
        curl ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=proxy&value=1'
    else
        echo '0error'
    fi
fi

if [[ ${proxyCENT} == '11' ]]; then
    docker start proxy
    curl ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=proxy&value=1'
else if [[ ${proxyCENT} == '10' ]]; then
    docker stop proxy
    curl ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=proxy&value=0'
fi

