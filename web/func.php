<?php
function dbquery($mod,$name,$do,$data){
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
?>  