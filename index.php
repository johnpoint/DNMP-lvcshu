<?php
include './config.php';
$do=$_GET['do'];
$key=$_GET['key'];
$ip=$_GET['ip'];
$hostname=$_GET['hostname'];

if ($key==$APIKEY) {
  if ($do=='add') {
    try {
      $conn = new PDO("mysql:host=$DBhost;dbname=$DBname", $DBusername, $DBpassword);
      // 设置 PDO 错误模式，用于抛出异常
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $SQL='INSERT INTO servers (ip, hostname) VALUES ('.$ip.','.$hostname.')';
      // 使用 exec() ，没有结果返回
      $conn->exec($SQL);
      echo "新记录插入成功";
    }
    catch(PDOException $e)
    {
      echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
  }
} else {
  echo 'api key 错误，无法进行操作 ！';
}








 ?>
