#!/bin/bash
url=''
key=''
cd /web/ssl/auto
ls > ../urllist
cat ../urllist | while read line
do
    cd /web/ssl/auto/$line
    curl $url'/getcerfile.php?secret='$key'&file='$line'/fullchain.cer' > fullchain.cer
    curl $url'/getcerfile.php?secret='$key'&file='$line'/'$line'.key' > $line.key
done
rm /web/ssl/urllist