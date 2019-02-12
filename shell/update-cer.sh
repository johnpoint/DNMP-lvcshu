#!/bin/bash
url=''
key=''
cd /web/ssl/auto
ls > ../urllist
cat ../urllist | while read line
do
    cd /web/ssl/auto/$line
    curl $url'getcerfile.php?file='$line'/fullchain.cer' -H 'cookie: user='$key > fullchain.cer
    curl $url'getcerfile.php?file='$line'/'$line'.key' -H 'cookie: user='$key > $line.key
done
rm /web/ssl/urllist