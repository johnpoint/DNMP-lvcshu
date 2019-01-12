<?php
include_once 'head.php';
include_once 'header.php';
include_once 'sidebar.php';
include_once 'config.php';
//main
$page=$_GET['page'];

if ($_COOKIE["user"] == ''){
  $page = 'login';
}elseif ($_COOKIE["user"] == md5($username.$userpasswd)) {
  if ($page == '') {
    $page='main';
  }
}else{
  $page = 'login';
}
include_once $page.'.php';
include_once 'footer.php';
 ?>
