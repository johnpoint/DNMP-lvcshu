<?php
$expire=time()+60*60*24*30;
setcookie("user",md5($_POST['user'].$_POST['passwd']),$expire);
header("Location: /index.php"); 
 ?>
