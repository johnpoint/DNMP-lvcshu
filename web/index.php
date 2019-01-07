<?php
include_once 'head.php';
include_once 'header.php';
include_once 'sidebar.php';
//main
$page=$_GET['page'];
if ($page == '') {
  $page='main';
}
include_once $page.'.php';

include_once 'footer.php';
 ?>
