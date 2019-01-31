<?php
include_once 'func.php';
$servername=$_GET['name'];
$action=$_GET['do'];
$secret=$_GET['secret'];

$SQLsecret=settingsDbEdit('view','secret',NULL,NULL);

if ($action == 'reg'){
    if ($secret == $SQLsecret){
        $ipv4=$_GET['ip'];
        $hostname=$_GET['hostname'];
        $ipv6=$_GET['ipv6'];
        serverDbEdit($ipv4,$ipv6,$hostname);
        echo '{"code":"0"}';
    } else {
        echo '{"code":"1","error_text":"SECRET error"}';
    }
} elseif ($action == 'get') {
    //索引数组转json
}
?>