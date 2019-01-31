<?php
include_once 'config.php';
include_once 'verify.php';
include_once 'func.php';
if ( $vcode == 1) {
    echo '<div class="mdui-container doc-container doc-no-cover">
    <h1 class="doc-title mdui-text-color-theme">服务器管理面板 - 管理</h1>
    <div class="doc-chapter">
      <div class="mdui-typo">
      <div id="serverinfo"></div>';
    $info = serverDbView();
    for($i = 0;$i <= 3;$i = $i +1)
        echo $info[$i]['id'];
        echo $info[$i]['ipv4'];
        echo $info[$i]['ipv6'];
        echo $info[$i]['hostname'];
    echo '</div>
    </div>';
} else {
    header("Location: /index.php");
}


?>