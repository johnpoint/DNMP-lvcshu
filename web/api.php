<?php
include_once 'func.php';
$servername=$_GET['name'];
$action=$_GET['do'];
$secret=$_GET['secret'];

$SQLsecret=dbquery('view','secret',NULL,NULL);

if ($action == 'reg'){
    if ($secret == $SQLsecret){
        
    } else {
        echo '{"code":"1","error_text":"SECRET error"}';
    }
} elseif ($action == 'get') {
    //索引数组转json
}
?>