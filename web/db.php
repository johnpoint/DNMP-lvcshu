<?php
include_once 'config.php';
if ($_COOKIE["user"] == md5($username.$userpasswd)) {
    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }

    // 预处理及绑定
    $select = $conn->prepare("SELECT * FROM settings WHERE name=?");
    $update = $conn->prepare("UPDATE settings SET data=? WHERE name=?");
    $update->bind_param("ss", $namevalue, $name);
    $select->bind_param("ss", $name);

    if ($_POST['mod'] == 'view') {
      $name=$_POST['name'];
      $select->execute();
      $select->close();
    } elseif ($_POST['edit']) {
      $name=$_POST['name'];
      $namevalue=$_POST['value'];
      $update->execute();
      $update->close();
    }
    $conn->close();
} else {
    header("Location: /index.php");
}
?>
