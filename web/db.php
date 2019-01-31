<?php
include_once 'func.php';
include_once 'config.php';
include_once 'verify.php';
if ( $vcode == 1) {
  if ($_POST['mod'] == 'update'){
    if ($_POST['do'] == 'md5'){
      $data=array($_POST['username'],$_POST['userpasswd'],$salt);
    } else {
      $data=$_POST['data'];
    } 
  } elseif ($_POST['mod'] == 'add') {
    $data=array($_POST['data1'], $_POST['data2']);
  } elseif ($_POST['mod'] == 'poll'){
    echo json_encode(serverDbView());
    return 0;
  }
  echo settingsDbEdit($_POST['mod'],$_POST['name'],$_POST['do'],$data);
} else {
  header("Location: /index.php");
}
?>