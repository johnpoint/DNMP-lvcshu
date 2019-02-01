<?php
include_once 'func.php';
$action=$_GET['do'];
$secret=$_GET['secret'];

$SQLsecret=settingsDbEdit('view','secret',NULL,NULL);

if ($secret == $SQLsecret){
    if ($action == 'reg'){
        $ipv4=$_GET['ip'];
        $hostname=$_GET['hostname'];
        $ipv6=$_GET['ipv6'];
        echo serverDbEdit($ipv4,$ipv6,$hostname,'add',NULL,NULL);
        echo '{"code":"0"}';
    } elseif ($action == 'get') {
        echo json_encode(serverDbView($_GET['ipv4']));
    } elseif ($action == 'repo') {
        $ipv4=$_GET['ipv4'];
        $key=$_GET['key'];
        $value=$_GET['value'];
        serverDbEdit($ipv4,NULL,NULL,'update',$key,$value);
    }
} else {
    echo '{"code":"1","error_text":"SECRET error"}';
}
 ?>