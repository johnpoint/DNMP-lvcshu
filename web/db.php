<?php
include_once 'func.php';
include_once 'config.php';
include_once 'verify.php';
if ( $vcode == 1) {
  if ($_POST['mod'] == 'update'){
    if ($_POST['do'] == 'md5'){
      $data=array($_POST['username'],$_POST['userpasswd'],$salt);
    } else {
      $data=$_POST['value'];
    } 
  } elseif ($_POST['mod'] == 'add') {
    $data=array($_POST['data1'], $_POST['data2']);
  }
  echo dbquery($_POST['mod'],$_POST['name'],$_POST['do'],$data);
} else {
  header("Location: /index.php");
}
?>