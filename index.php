<?php
include './config.php';
$do=$_GET['do'];
$key=$_GET['key'];
$ip=$_GET['ip'];
$ipv6=$_GET['ipv6'];
$hn=$_GET['hostname'];
$serverid=$_GET['serverid'];
$table=$_GET['table'];

if ($key==$APIKEY) {
  $conn = new mysqli($DBhost, $DBusername, $DBpassword, $DBname);
  if ($conn->connect_error) {
      die("连接失败: " . $conn->connect_error);
  }
  if ($do=='add') {
    $SQL='INSERT INTO'.$table.'(ip,ipv6,hostname,serverid) VALUES (\''.$ip.'\',\''.$ipv6.'\',\''.$hn.'\',\''.$serverid.'\')';
  } elseif ($do=='del') {
    $SQL='DELETE FROM'.$table.'WHERE serverid='.$serverid;
  } /*elseif ($do=='update') {
    // TODO
  }*/
  if ($conn->query($SQL) === TRUE) {
      echo "{\"code\":\"200\"}";
  } else {
      echo "{\"code\":\"423\",\"message\":\"".$conn->error."\"}";
  }
  $conn->close();
} else {
  echo "{\"code\":\"403\"}";
}
 ?>
