#!/bin/sh

rm data/* -rf

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
  echo "证书状态: "${data##* } >> "data/$line"

  startdate=$(date -d "${startdate}" +%s)
  enddate=$(date -d "${enddate}" +%s)
  datee=$(date -d "${datee}" +%s)

  long=$(($enddate-$startdate))
  datee=$(($datee-$startdate))
  datee=$(($datee*100))
  hundred=100
  persent=$(($datee/$long))

  echo "<div class=\"mdui-progress\"><div class=\"mdui-progress-determinate\" style=\"width: ${persent}%;\"></div></div>" >> "data/$line"

  rm "data/$line.ca"
done
