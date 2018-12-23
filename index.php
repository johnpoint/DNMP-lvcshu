<?php
include './config.php';
$do=$_GET['do'];
$key=$_GET['key'];
$ip=$_GET['ip'];
$ipv6=$_GET['ipv6'];
$hn=$_GET['hostname'];
$serverid=$_GET['serverid'];

if ($key==$APIKEY) {
  if ($do=='add') {
    $conn = new mysqli($DBhost, $DBusername, $DBpassword, $DBname);
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    $SQL='INSERT INTO servers (ip,ipv6,hostname,serverid) VALUES (\''.$ip.'\',\''.$ipv6.'\',\''.$hn.'\',\''.$serverid.'\')';
    if ($conn->query($SQL) === TRUE) {
        echo "服务器注册成功！";
    } else {
        echo "Error: " . $SQL . "<br>" . $conn->error;
    }
    $conn->close();
  }
} else {
  echo 'api key 错误，无法进行操作 ！';
}
 ?>
