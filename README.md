# DNMP-lvcshu

# DNMP脚本

## 执行脚本

```
wget https://raw.githubusercontent.com/johnpoint/DNMP-lvcshu/master/DNMP && bash DNMP install && soure ~/.bashrc
```

- - -

执行脚本后会安装的组件：

- docker [nginx-lvcshu](https://cloud.docker.com/u/johnpoint/repository/docker/johnpoint/nginx-lvcshu) | nginx:lastest
- docker [php-lvcshu](https://cloud.docker.com/u/johnpoint/repository/docker/johnpoint/php-lvcshu) | php 7.2
- docker [mysql:5.7.23](https://hub.docker.com/_/mysql/scans/library/mysql/5.7.23)

## 脚本 nginx 配置文件

- http访问
- https访问
- http 301 重定向 https
- ipv6 访问
- HSTS(**H**TTP **S**trict **T**ransport **S**ecurity) header 设置

# THANKS

- [BotoX/ServerStatus](https://github.com/BotoX/ServerStatus)

# LICENSE

GPL v3.0