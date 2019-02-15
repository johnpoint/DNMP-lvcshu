<?php
include_once 'config.php';
include_once 'func.php';
$secret=$_GET['secret'];
$SQLsecret=settingsDbEdit('view','secret',NULL,NULL);

if ($secret == $SQLsecret) {
    $myfile = fopen('ssl/'.$_GET['file'], "r") or die("Unable to open file!");
    echo fread($myfile, filesize('ssl/'.$_GET['file']));
    fclose($myfile);
} else {
    echo '{"code":"1","error_text":"SECRET error"}';
}
?>
