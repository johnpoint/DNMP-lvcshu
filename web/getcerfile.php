<?php
include_once 'config.php';
if ($_COOKIE["user"] == $usercookie) {
    $myfile = fopen($_GET['file'], "r") or die("Unable to open file!");
    echo fread($myfile, filesize($_GET['file']));
    fclose($myfile);
} else {
    header("Location: /index.php");
}
?>
