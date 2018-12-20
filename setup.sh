#!/bin/bash

Green_font_prefix="\033[32m" && Red_font_prefix="\033[31m" && Green_background_prefix="\033[42;37m" && Red_background_prefix="\033[41;37m" && Font_color_suffix="\033[0m"
Info="${Green_font_prefix}[信息]${Font_color_suffix}"
Error="${Red_font_prefix}[错误]${Font_color_suffix}"
Tip="${Green_font_prefix}[注意]${Font_color_suffix}"

[[ $EUID != 0 ]] && echo -e "${Error} 当前账号非ROOT(或没有ROOT权限)，无法继续操作，请使用${Green_background_prefix} sudo su ${Font_color_suffix}来获取临时ROOT权限（执行后会提示输入当前账号的密码）。" && exit 1

if [ -f /etc/redhat-release ]; then
    release="centos"
    PM='yum'
elif cat /etc/issue | grep -Eqi "debian"; then
    release="debian"
    PM='apt-get'
elif cat /etc/issue | grep -Eqi "ubuntu"; then
    release="ubuntu"
    PM='apt-get'
elif cat /etc/issue | grep -Eqi "centos|red hat|redhat"; then
    release="centos"
    PM='yum'
elif cat /proc/version | grep -Eqi "debian"; then
    release="debian"
    PM='apt-get'
elif cat /proc/version | grep -Eqi "ubuntu"; then
    release="ubuntu"
    PM='apt-get'
elif cat /proc/version | grep -Eqi "centos|red hat|redhat"; then
    release="centos"
    PM='yum'
 else
    echo -e "${Error}无法识别~"
    exit 0
fi

install(){
  echo " ____  _   _ __  __ ____       _               _
|  _ \| \ | |  \/  |  _ \     | |_   _____ ___| |__  _   _
| | | |  \| | |\/| | |_) |____| \ \ / / __/ __| '_ \| | | |
| |_| | |\  | |  | |  __/_____| |\ V / (__\__ \ | | | |_| |
|____/|_| \_|_|  |_|_|        |_| \_/ \___|___/_| |_|\__,_|

"
  $PM update -y
  $PM upgrade
  $PM install curl unzip -y
  curl -fsSL get.docker.com -o get-docker.sh
  sh get-docker.sh --mirror Aliyun
  systemctl enable docker
  systemctl start docker
  curl -L https://github.com/docker/compose/releases/download/1.19.0/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose
  chmod +x /usr/local/bin/docker-compose
  mkdir /web/vhost /web/conf -p
  curl  https://get.acme.sh | sh
  wget https://git.lvcshu.com/johnpoint/DNMP-lvcshu/raw/master/docker-compose.yml
  sed -i 's/*/DNMP-lvcshu/g' docker-compose.yml
  docker-compose up -d
}

add_ssl_cer(){
	echo "====================="
	ls /web/vhost
	echo "====================="
	echo -e "输入域名:"
  read -p "(默认: google.com)" dom
	add_ssl
	ssl_config
	docker restart nginx
}

install_phpmyadmin(){
	echo "====================="
	ls /web/vhost
	echo "====================="
  echo -e "输入域名:"
  read -p "(默认: google.com)" dom
  if [[ ! -z ${dom} ]];then
    cd /web/vhost/${dom}
    wget https://files.phpmyadmin.net/phpMyAdmin/4.8.3/phpMyAdmin-4.8.3-all-languages.zip
    unzip *.zip
    rm *.zip -f
    mv php* phpmyadmin
    cd /web/vhost/${dom}/phpmyadmin
    mkdir tmp
    chmod 777 tmp -R
    wget https://git.lvcshu.com/johnpoint/DNMP-lvcshu/raw/master/config.inc.php
  else
    echo -e "${Error}没有输入域名"
    exit
  fi
}

add_vhost(){
  echo -e "输入域名:"
  read -p "(默认: google.com)" dom
  echo -e "使用SSL？(yn):"
  read -p "(默认:n)" sslyn
  if [[ ! -z ${dom} ]];then
    make_dir
    make_config
    add_index
    if [[ ${sslyn} == "y"  ]]; then
        docker restart nginx
        add_ssl
        ssl_config
        docker restart nginx
      else
        docker restart nginx
      fi
  else
    echo -e "${Error}无输入，退出"
    exit
  fi
  exit
}

add_ssl(){
  ~/.acme.sh/acme.sh  --issue  -d $dom --webroot  /web/vhost/$dom
}

make_dir(){
  cd /web/vhost
  mkdir $dom
}

make_config(){
  cd /web/conf
  touch $dom.conf
  echo "server
      {
          listen 80;
          #listen [::]:80;
          server_name ZZ ;
          index index.html index.htm index.php default.html default.htm default.php;
          root  /web/vhost/${dom};
        	#return 301 https://${dom}$request_uri;

          #include rewrite/none.conf;
          #error_page   404   /404.html;

          # Deny access to PHP files in specific directory
          #location ~ /(wp-content|uploads|wp-includes|images)/.*\.php$ { deny all; }

          location ~ \.php$ {
              fastcgi_pass   php-fpm:9000;
              fastcgi_index  index.php;
              fastcgi_param  SCRIPT_FILENAME  /web/vhost/${dom}$fastcgi_script_name;
              include        fastcgi_params;
          }

          location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
          {
              expires      30d;
          }

          location ~ .*\.(js|css)?$
          {
              expires      12h;
          }

          location ~ /.well-known {
              allow all;
          }

          location ~ /\.
          {
              deny all;
          }

          access_log off;
      }
  " > /web/conf/${dom}.conf
}

ssl_config(){
  cd /web/conf
  echo "server
      {
          listen 443 ssl http2;
          #listen [::]:443 ssl http2;
          server_name ${dom} ;
          index index.html index.htm index.php default.html default.htm default.php;
          root  /web/vhost/${dom};
          ssl on;
          ssl_certificate /web/ssl/${dom}/fullchain.cer;
          ssl_certificate_key /web/ssl/${dom}/${dom}.key;
          ssl_session_timeout 5m;
          ssl_protocols TLSv1.1 TLSv1.2;
          ssl_prefer_server_ciphers on;
          ssl_ciphers \"EECDH+CHACHA20:EECDH+CHACHA20-draft:EECDH+AES128:RSA+AES128:EECDH+AES256:RSA+AES256:EECDH+3DES:RSA+3DES:!MD5\";
          ssl_session_cache builtin:1000 shared:SSL:10m;
          # openssl dhparam -out /usr/local/nginx/conf/ssl/dhparam.pem 2048
          # ssl_dhparam /usr/local/nginx/conf/ssl/dhparam.pem;
          #add_header Strict-Transport-Security \"max-age=31536000; includeSubDomains\" always;
          #include rewrite/none.conf;
          #error_page   404   /404.html;

          # Deny access to PHP files in specific directory
          #location ~ /(wp-content|uploads|wp-includes|images)/.*\.php$ { deny all; }

          location ~ \.php$ {
              fastcgi_pass   php-fpm:9000;
              fastcgi_index  index.php;
              fastcgi_param  SCRIPT_FILENAME  /web/vhost/${dom}$fastcgi_script_name;
              include        fastcgi_params;
          }

          location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
          {
              expires      30d;
          }

          location ~ .*\.(js|css)?$
          {
              expires      12h;
          }

          location ~ /.well-known {
              allow all;
          }

          location ~ /\.
          {
              deny all;
          }

          access_log off;
      }" >> /web/conf/${dom}.conf
}

add_index(){
  cd /web/vhost/${dom}
  touch index.html
  echo " ____  _   _ __  __ ____       _               _
|  _ \| \ | |  \/  |  _ \     | |_   _____ ___| |__  _   _
| | | |  \| | |\/| | |_) |____| \ \ / / __/ __| '_ \| | | |
| |_| | |\  | |  | |  __/_____| |\ V / (__\__ \ | | | |_| |
|____/|_| \_|_|  |_|_|        |_| \_/ \___|___/_| |_|\__,_|

" > index.html
}

del_vhost(){
  echo "====================="
  ls /web/vhost
  echo "====================="
  echo -e "输入域名:"
  read -p "(默认: exit)" dom
  if [[ ! -z ${dom} ]];then
    del_dom
  else
    echo -e "${Error}无输入，退出"
  fi
}

del_dom(){
  cd /web/vhost
  rm $dom -rf
  cd /web/conf
  rm $dom.conf
  docker restart nginx
}

if [[ ! -z $1  ]]; then
  if [[ $1 = 'nginx'  ]]; then
    if [[ ! -z $2  ]]; then
      docker $2 nginx
    else
      echo -e "${Error}无法识别的参数(start,stop,restart)"
      exit
    fi
  elif [[ $1 = 'mysql'  ]]; then
    if [[ ! -z $2  ]]; then
      docker $2 mysql
    else
      echo -e "${Error}无法识别的参数(start,stop,restart)"
      exit
    fi
  elif [[ $1 = 'php' ]]; then
    if [[ ! -z $2 ]]; then
      docker $2 php-fpm
    else
      echo -e "${Error}无法识别的参数(start,stop,restart)"
      exit
    fi
  elif [[ $1 = 'vhost' ]]; then
    if [[ $2 = 'add' ]]; then
      add_vhost
    elif [[ $2 = 'del' ]]; then
      del_vhost
    elif [[ $2 = 'ls' ]]; then
      echo "====================="
      ls /web/vhost
      echo "====================="
    else
      echo -e "${Error}无法识别的参数(add,del,list)"
      exit
    fi
  elif [[ $1 = 'install' ]]; then
    install
  elif [[ $1 = 'v' ]]; then
  	echo -e "${Info}版本：${ver}"
  elif [[ $1 = 'admin' ]]; then
    install_phpmyadmin
  elif [[ $1 = 'start' ]]; then
    docker start nginx php-fpm mysql
  elif [[ $1 = 'stop' ]]; then
    docker stop nginx php-fpm mysql
  elif [[ $1 = 'restart' ]]; then
    docker restart nginx php-fpm mysql
	elif [[ $1 = 'ssl' ]]; then
		if [[ $2 = 'add' ]]; then
			add_ssl_cer
		else
			echo -e "${Error}无法识别的参数"
		fi
  else
    echo -e "${Error}无法识别的参数(install?)"
    exit
  fi
else
  echo -e "${Error}没有参数"
  exit
fi
