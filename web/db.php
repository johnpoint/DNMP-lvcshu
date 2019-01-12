<?php
include_once 'config.php';
include_once 'verify.php';
if ( $vcode == 1) {
    // 创建连接
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }

    // 预处理及绑定
    //$select = $conn->prepare("SELECT data FROM settings WHERE name=?");
    $query = "SELECT data FROM settings WHERE name=";
    $update = $conn->prepare("UPDATE settings SET data=? WHERE name=?");

    if ($_POST['mod'] == 'view') {
      $name=$_POST['name'];
      $query = $query ."'".$name."'" ;
      //echo $query;
      $result = $conn->query($query);
      //$select->bind_param("s", $name);
      //$result = $select->execute();
      //echo $result;
      $row = mysqli_fetch_assoc($result);
      echo $row["data"];
      //$select->close();
    } elseif ($_POST['mod'] == 'update') {
      $name=$_POST['name'];
      if ($_POST['do'] == 'md5') {
        $value=md5($_POST['username'].$_POST['userpasswd'].$salt);
      } else {
        $value=$_POST['value'];
      }
      $update->bind_param("ss", $value, $name);
      echo $update->execute();
      $update->close();
    }
    $conn->close();
} else {
    header("Location: /index.php");
}
?>
