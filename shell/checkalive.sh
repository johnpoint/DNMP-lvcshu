#!/bin/bash
url=$1
secret=$2
ipv4=$(curl -q ip.sb -4)
while((1));do
    curl -q 'https://'${url}'/api.php?do=get&ipv4='${ipv4}'&secret='${secret} > data.json
    #nginx
    nginxCENT=$(cat data.json |jq -r .info[0].nginx)
    nginx=$(docker ps|grep nginx)
    if [[ ! $nginx ]]; then
        echo 'nginx off'
        if [[ ${nginxCENT} == '1' ]]; then
            curl -q 'https://'${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=nginx&value=0'
        else
            echo '0error'
        fi
    else
        echo 'nginx on'
        if [[ ${nginxCENT} == '0' ]]; then
            curl -q 'https://'${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=nginx&value=1'
        else
            echo '0error'
        fi
    fi

    if [[ ${nginxCENT} == '11' ]]; then
        echo 'nginx on'
        docker start nginx
        curl -q 'https://'${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=nginx&value=1'
    elif [[ ${nginxCENT} == '10' ]]; then
        echo 'nginx off'
        docker stop nginx
        curl -q 'https://'${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=nginx&value=0'
    fi

    #phpfpm
    phpfpmCENT=$(cat data.json |jq -r .info[0].phpfpm)
    phpfpm=$(docker ps|grep php-fpm)
    if [[ ! $phpfpm ]]; then
        if [[ ${phpfpmCENT} == '1' ]]; then
            curl -q 'https://'${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=phpfpm&value=0'
        else
            echo '0error'
        fi
    else
        if [[ ${phpfpmCENT} == '0' ]]; then
            curl -q 'https://'${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=phpfpm&value=1'
        else
            echo '0error'
        fi
    fi

    if [[ ${phpfpmCENT} == '11' ]]; then
        docker start php-fpm
        curl -q 'https://'${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=phpfpm&value=1'
    elif [[ ${phpfpmCENT} == '10' ]]; then
        docker stop php-fpm
        curl -q 'https://'${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=phpfpm&value=0'
    fi

    #mysql
    mysqlCENT=$(cat data.json |jq -r .info[0].mysql)
    mysql=$(docker ps|grep mysql)
    if [[ ! $mysql ]]; then
        if [[ ${mysqlCENT} == '1' ]]; then
            curl -q 'https://'${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=mysql&value=0'
        else
            echo '0error'
        fi
    else
        if [[ ${mysqlCENT} == '0' ]]; then
            curl -q 'https://'${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=mysql&value=1'
        else
            echo '0error'
        fi
    fi

    if [[ ${mysqlCENT} == '11' ]]; then
        docker start mysql
        curl -q 'https://'${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=mysql&value=1'
    elif [[ ${mysqlCENT} == '10' ]]; then
        docker stop mysql
        curl -q 'https://'${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=mysql&value=0'
    fi

    #proxy
    proxyCENT=`cat data.json |jq -r .info[0].Nupdate`

    if [[ ${proxyCENT} == '11' ]]; then
        curl 'https://'${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=Nupdate&value=1'
        cd ~
        docker stop nginx
        docker container prune -f
        docker image rm johnpoint/nginx-lvcshu:latest
        docker-compose up -d
        cd $(pwd)
    elif [[ ${proxyCENT} == '10' ]]; then
        curl 'https://center.lvcshu.com/api.php?do=repo&ipv4=$(curl ip.sb -4)&secret=6fcf0861&key=Nupdate&value=1'
        cd ~
        docker stop nginx
        docker container prune -f
        docker image rm johnpoint/nginx-lvcshu:latest
        docker-compose up -d
        cd $(pwd)
    fi

    sleep 1s

done