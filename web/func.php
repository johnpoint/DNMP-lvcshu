<?php
function settingsDbEdit($mod,$name,$do,$data){
  include 'config.php';
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

function serverDbEdit($ipv4,$ipv6,$hostname,$mod,$key,$value){
  include 'config.php';
  if ($mod == 'add') {
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
      return 'error'. $conn->connect_error;
    }
    $insert = $conn->prepare("INSERT INTO servers (hostname,ipv4,ipv6) VALUES (?,?,?)");
    $insert->bind_param("sss", $hostname,$ipv4,$ipv6);
    $returndata=$insert->execute();
    $insert->close();
    return $returndata;
  } elseif ($mod == 'update') {
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
      return 'error'. $conn->connect_error;
    }
    $update = "UPDATE servers SET ".$key."=".$value." WHERE ipv4=\"".$ipv4."\"";
    $returndata = $conn->query($update);
    return $returndata;
  }
}

function serverDbView($name){
  include 'config.php';
  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
  if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
  }
  if ($name == '*'){
    $where = '>=0' ;
  } else {
    $where = '="'.$name.'"';
  }
  $query = "SELECT * FROM servers WHERE ipv4".$where;
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    $data = array();
    $data['info'] = array();
    $num = -1;
    while($row = $result->fetch_assoc()) {
      $num = $num + 1;
      $info['id'] = $row['id'];
      $info['hostname'] = $row['hostname'];
      $info['ipv4'] = $row['ipv4'];
      $info['ipv6'] = $row['ipv6'];
      $info['nginx'] = $row['nginx'];
      $info['phpfpm'] = $row['phpfpm'];
      $info['mysql'] = $row['mysql'];
      $info['proxy'] = $row['proxy'];
      array_push($data['info'],$info);
    }
    $data['num'] = $num;
    return $data;
  } else {
    return '{"code":"1"}';
  }
}

?>  