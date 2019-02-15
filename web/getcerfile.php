<?php
include_once 'config.php';
include_once 'verify.php';
if ( $vcode == 1) {
    $myfile = fopen('ssl/'.$_GET['file'], "r") or die("Unable to open file!");
    echo fread($myfile, filesize('ssl/'.$_GET['file']));
    fclose($myfile);
} else {
    header("Location: /index.php");
}
?>
