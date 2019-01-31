#!/bin/bash
url=''
cat url.list | while read line
do
    cd /web/ssl/auto/$line
    curl $url$line'/fullchain.cer' -H 'cookie: user='$1 > fullchain.cer
    curl $url$line'/'$line'.key' -H 'cookie: user='$1 > $line.key
done