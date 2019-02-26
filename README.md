# DNMP-lvcshu

# DNMP脚本

## 执行脚本

```
wget https://raw.githubusercontent.com/johnpoint/DNMP-lvcshu/master/DNMP && bash DNMP install && source ~/.bashrc
```

**注意:脚本执行完毕后 MYSQL 默认密码 DNMP-lvcshu ,请及时修改**

- - -

执行脚本后会安装的组件：

| 类型 | 名称 | 版本 | 对外端口 |
| --- | --- | --- | --- | --- |
|docker| [nginx-lvcshu](https://cloud.docker.com/u/johnpoint/repository/docker/johnpoint/nginx-lvcshu) | nginx:lastest | 80 / 443 |
|docker|[php-lvcshu](https://cloud.docker.com/u/johnpoint/repository/docker/johnpoint/php-lvcshu) | php 7.2 | / |
|docker|[mysql:5.7.23](https://hub.docker.com/_/mysql/scans/library/mysql/5.7.23)|mysql:5.7.23|/|

## 脚本生成 nginx 配置文件

- http访问
- https访问
- http 301 重定向 https
- ipv6 访问
- HSTS(**H**TTP **S**trict **T**ransport **S**ecurity) header 设置

## 相关路径

所有文件均在 `/web` 文件夹下

| 路径 | 内容 |
|---|---|
|/web/vhost|虚拟主机网站文件夹，按域名命名|
|/web/ssl|域名 TLS 证书|
|/web/conf|域名 nginx 配置文件|
|/web/mysql|mysql数据|
|/web/backup|备份文件|

# THANKS

- [BotoX/ServerStatus](https://github.com/BotoX/ServerStatus)

# LICENSE

GPL v3.0