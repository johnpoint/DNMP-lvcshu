#!/bin/sh

cat urlfile.list | while read line
do
  touch "data/$line"
  touch "data/$line.ca"
  curl https://$line -v -s -o /dev/null 2>"data/$line.ca"
  datee=$(date +'%F %H:%M')
  echo "最后检查: " $datee > "data/$line"

  data=$(cat "data/$line.ca" | grep 'subject:')
  echo "证书域名: " ${data##* subject: } >> "data/$line"

  data=$(cat "data/$line.ca" | grep 'start date:')
  data=$(date -d "${data##* start date: }" +'%F %H:%M:%S')
  echo "签发日期: "${data} >> "data/$line"
  startdate=$data

  data=$(cat "data/$line.ca" | grep 'expire date: ')
  data=$(date -d "${data##* expire date: }" +'%F %H:%M:%S')
  echo "失效日期: " $data >> "data/$line"
  enddate=$data

  data=$(cat "data/$line.ca" | grep 'issuer: ')
  echo "签发机构: "${data##* issuer: } >> "data/$line"

  data=$(cat "data/$line.ca" | grep 'SSL certificate verify ok.')

  if [[ -z $data ]];then
    echo '<img src="https://img.shields.io/badge/SSL-error-red.svg">' >> "data/$line"
    rm "data/$line.ca"
    exit
  else
    echo '<img src="https://img.shields.io/badge/SSL-ok-green.svg">' >> "data/$line"
  fi

  startdate=$(date -d "${startdate}" +%s)
  enddate=$(date -d "${enddate}" +%s)
  datee=$(date -d "${datee}" +%s)

  long=$(($enddate-$startdate))
  datee=$(($datee-$startdate))
  datee=$(($datee*100))
  hundred=100
  persent=$(($datee/$long))
  #persent=`expr $persent\*$hundred`

  echo "<div class=\"mdui-progress\"><div class=\"mdui-progress-determinate\" style=\"width: ${persent}%;\"></div></div>" >> "data/$line"

  rm "data/$line.ca"
done
