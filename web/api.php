<?php
include_once 'func.php';
$action=$_GET['do'];
$secret=$_GET['secret'];

$SQLsecret=settingsDbEdit('view','secret',NULL,NULL);

if ($action == 'reg'){
    if ($secret == $SQLsecret){
        $ipv4=$_GET['ip'];
        $hostname=$_GET['hostname'];
        $ipv6=$_GET['ipv6'];
        echo serverDbEdit($ipv4,$ipv6,$hostname);
        echo '{"code":"0"}';
    } else {
        echo '{"code":"1","error_text":"SECRET error"}';
    }
} elseif ($action == 'get') {
    if ($secret == $SQLsecret){
        echo json_encode(serverDbView($_GET['ipv4']));
    } else {
        echo '{"code":"1","error_text":"SECRET error"}';
    }
}
?>