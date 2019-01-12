<?php
include_once 'config.php';
$expire=time()+60*60*3;
setcookie("user",md5($_POST['user'].$_POST['passwd'].$salt),$expire);
header("Location: /index.php");
 ?>
