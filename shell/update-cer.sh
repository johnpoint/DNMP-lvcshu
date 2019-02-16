#!/bin/bash
url=''
key=''
cd /web/ssl/auto
ls > ../urllist
cat ../urllist | while read line
do
    cd /web/ssl/auto/$line
    curl $url'/getcerfile.php?secret='$key'&file='$line'/fullchain.cer' | sed 's/^[ \t]*//g' > fullchain.cer
    curl $url'/getcerfile.php?secret='$key'&file='$line'/'$line'.key' | sed 's/^[ \t]*//g' > $line.key
done
rm /web/ssl/urllist