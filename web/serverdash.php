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
    $deinfo = json_decode($info);
    echo $info;
    echo '---';
    echo $deinfo;
    echo '</div>
    </div>
    </div>';
} else {
    header("Location: /index.php");
}


?>