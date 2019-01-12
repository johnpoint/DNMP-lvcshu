<?php
include_once 'config.php';
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$query = "SELECT data FROM settings WHERE name='usercookie'";
$result = $conn->query($query);
$row = mysqli_fetch_assoc($result);
if ($_COOKIE['user'] == $row["data"]) {
  $vcode = 1;
} else {
  exit;
}
 ?>
