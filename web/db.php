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
    $query = "SELECT * FROM settings WHERE name=";
    $update = $conn->prepare("UPDATE settings SET data=? WHERE name=?");
    $insert = $conn->prepare("INSERT INTO settings (name,data,data2) VALUES (?,?,?)");

    if ($_POST['mod'] == 'view') {
      $name=$_POST['name'];
      $query = $query ."'".$name."'" ;
      //echo $query;
      $result = $conn->query($query);
      //$select->bind_param("s", $name);
      //$result = $select->execute();
      //echo $result;
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          if ($row['data2'] != '') {
            echo $row["data"].'  /  '.$row["data2"].'<br>';
          } else {
            echo $row['data'];
          }
        }
      } else {
        echo "0 结果";
      }
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
    } elseif ($_POST['mod'] == 'add') {
      $insert->bind_param("sss", $_POST['name'], $_POST['data1'], $_POST['data2']);
      echo $insert->execute();
      $insert->close();
    }
    $conn->close();
} else {
    header("Location: /index.php");
}
?>
