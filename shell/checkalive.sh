#!/usr/bin/bash
url='https://center.lvcshu.com'
secret='1234567'
ipv4=$(curl -q ip.sb -4)
while((1));do
    curl -q ${url}'/api.php?do=get&ipv4='${ipv4}'&secret='${secret} > data.json
    #nginx
    nginxCENT=$(cat data.json |jq -r .info[0].nginx)
    nginx=$(docker ps|grep nginx)
    if [[ ! $nginx ]]; then
        echo 'nginx off'
        if [[ ${nginxCENT} == '1' ]]; then
            curl -q ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=nginx&value=0'
        else
            echo '0error'
        fi
    else
        echo 'nginx on'
        if [[ ${nginxCENT} == '0' ]]; then
            curl -q ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=nginx&value=1'
        else
            echo '0error'
        fi
    fi

    if [[ ${nginxCENT} == '11' ]]; then
        echo 'nginx on'
        docker start nginx
        curl -q ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=nginx&value=1'
    elif [[ ${nginxCENT} == '10' ]]; then
        echo 'nginx off'
        docker stop nginx
        curl -q ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=nginx&value=0'
    fi

    #phpfpm
    phpfpmCENT=$(cat data.json |jq -r .info[0].phpfpm)
    phpfpm=$(docker ps|grep php-fpm)
    if [[ ! $phpfpm ]]; then
        if [[ ${phpfpmCENT} == '1' ]]; then
            curl -q ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=phpfpm&value=0'
        else
            echo '0error'
        fi
    else
        if [[ ${phpfpmCENT} == '0' ]]; then
            curl -q ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=phpfpm&value=1'
        else
            echo '0error'
        fi
    fi

    if [[ ${phpfpmCENT} == '11' ]]; then
        docker start php-fpm
        curl -q ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=phpfpm&value=1'
    elif [[ ${phpfpmCENT} == '10' ]]; then
        docker stop php-fpm
        curl -q ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=phpfpm&value=0'
    fi

    #mysql
    mysqlCENT=$(cat data.json |jq -r .info[0].mysql)
    mysql=$(docker ps|grep mysql)
    if [[ ! $mysql ]]; then
        if [[ ${mysqlCENT} == '1' ]]; then
            curl -q ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=mysql&value=0'
        else
            echo '0error'
        fi
    else
        if [[ ${mysqlCENT} == '0' ]]; then
            curl -q ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=mysql&value=1'
        else
            echo '0error'
        fi
    fi

    if [[ ${mysqlCENT} == '11' ]]; then
        docker start mysql
        curl -q ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=mysql&value=1'
    elif [[ ${mysqlCENT} == '10' ]]; then
        docker stop mysql
        curl -q ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=mysql&value=0'
    fi

    #proxy
    proxyCENT=`cat data.json |jq -r .info[0].proxy`
    proxy=$(docker ps|grep proxy)
    if [[ ! $proxy ]]; then
        if [[ ${proxyCENT} == '1' ]]; then
            curl -q ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=proxy&value=0'
        else
            echo '0error'
        fi
    else
        if [[ ${proxyCENT} == '0' ]]; then
            curl -q ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=proxy&value=1'
        else
            echo '0error'
        fi
    fi

    if [[ ${proxyCENT} == '11' ]]; then
        docker start proxy
        curl -q ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=proxy&value=1'
    elif [[ ${proxyCENT} == '10' ]]; then
        docker stop proxy
        curl -q ${url}'/api.php?do=repo&ipv4='${ipv4}'&secret='${secret}'&key=proxy&value=0'
    fi

    sleep 1s

done