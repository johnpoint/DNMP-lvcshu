<?php
include_once 'config.php';
if ($_COOKIE["user"] == md5($username.$userpasswd)) {
    $myfile = fopen($_GET['file'], "r") or die("Unable to open file!");
    echo fread($myfile, filesize($_GET['file']));
    fclose($myfile);
} else {
    header("Location: /index.php");
}
?>
