<?php
include_once 'config.php';
include_once 'verify.php';
if ( $vcode == 1) {
    echo '<div class="mdui-container doc-container doc-no-cover">
    <h1 class="doc-title mdui-text-color-theme">服务器管理面板 - 证书分发</h1>
    <div class="doc-chapter">
      <div class="mdui-typo">
      <div id="serverinfo"></div>'
    echo serverDbView();
    echo '</div>
    </div>
    </div>'
} else {
    header("Location: /index.php");
}


?>