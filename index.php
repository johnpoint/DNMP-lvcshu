<?php
include './config.php';
$do=$_GET['do'];
$key=$_GET['key'];
$ip=$_GET['ip'];
$ipv6=$_GET['ipv6'];
$hn=$_GET['hostname'];
$serverid=$_GET['serverid'];
$what=$_GET['what'];

if ($key==$APIKEY) {
  $conn = new mysqli($DBhost, $DBusername, $DBpassword, $DBname);
  if ($conn->connect_error) {
      die("{\"code\":\"500\",\"message\":\"".$conn->connect_error."}");
  }
  if ($do=='add') {
    $SQL='INSERT INTO '.$what.' (ip,ipv6,hostname,serverid) VALUES (\''.$ip.'\',\''.$ipv6.'\',\''.$hn.'\',\''.$serverid.'\')';
    $back='服务器注册成功';
  } elseif ($do=='del') {
    $SQL='DELETE FROM'.$what.'WHERE serverid='.$serverid;
    $back='服务器删除成功';
  } /*elseif ($do=='update') {
    // TODO
  }*/
  if ($conn->query($SQL) === TRUE) {
      echo "{\"code\":\"200\",\"message\":\"".$back."\"}";
  } else {
      echo "{\"code\":\"423\",\"message\":\"".$conn->error."\",\"SQL\":\"".$SQL."\"}";
  }
  $conn->close();
} else {
  echo "{\"code\":\"403\"}";
}
 ?>
