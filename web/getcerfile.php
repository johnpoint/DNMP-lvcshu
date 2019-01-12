<?php
include_once 'config.php';
include_once 'verify.php';
if ( $vcode == 1) {
    $myfile = fopen($_GET['file'], "r") or die("Unable to open file!");
    echo fread($myfile, filesize($_GET['file']));
    fclose($myfile);
} else {
    header("Location: /index.php");
}
?>
