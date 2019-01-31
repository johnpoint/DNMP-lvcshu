<?php
function settingsDbEdit($mod,$name,$do,$data){
  include_once 'config.php';
  // 创建连接
  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
  
  // 检测连接
  if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
  }
  
  // 预处理及绑定
  $query = "SELECT * FROM settings WHERE name=";
  $update = $conn->prepare("UPDATE settings SET data=? WHERE name=?");
  $insert = $conn->prepare("INSERT INTO settings (name,data,data2) VALUES (?,?,?)");
  
  if ($mod == 'view') {
    $query = $query ."'".$name."'" ;
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        if ($row['data2'] != '') {
        return $row["data"].'  /  '.$row["data2"].'<br>';
        } else {
        return $row['data'];
        }
      }
    } else {
      return "0 结果";
    }
  } elseif ($mod == 'update') {
    if ($do == 'md5') {
      $value=md5($data[0].$data[1].$data[2]);
    } else {
      $value=$data;
    }
    $update->bind_param("ss", $value, $name);
    $returndata = $update->execute();
    $update->close();
    return $returndata;
  } elseif ($_POST['mod'] == 'add') {
    $insert->bind_param("sss", $name, $data[0], $data[1]);
    $returndata=$insert->execute();
    $insert->close();
    return $returndata;
  }
  $conn->close();
}

function serverDbEdit ($ipv4,$ipv6,$hostname){
  include_once 'config.php';
  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
  if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
  }
  $insert = $conn->prepare("INSERT INTO servers (hostname,ipv4,ipv6) VALUES (?,?,?)");
  $insert->bind_param("sss", $ipv4,$ipv6,$hostname);
  $returndata=$insert->execute();
  $insert->close();
  return $returndata;
}

function serverDbView(){
  include_once 'config.php';
  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
  if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
  }
  $query = "SELECT * FROM settings";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $data = $data . json_encode($row);
    }
    return $data;
  } else {
    return '{"code":"1"}';
  }
}

?>  