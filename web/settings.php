<?php
include_once 'config.php';
if ($_COOKIE["user"] == md5($username.$userpasswd)) {
    echo '<div class="mdui-container doc-container doc-no-cover">
  <h1 class="doc-title mdui-text-color-theme">服务器管理面板 - 设置</h1>
  <div class="doc-chapter">
    <div class="mdui-typo">';
    echo '<div class="mdui-panel" mdui-panel>';
    echo '<div class="mdui-panel-item">';
    echo '<div class="mdui-panel-item-header">'usercookie'</div>';
    echo '<div class="mdui-panel-item-body">';
    echo '<code id='cookie'></code>';
    echo '</div>';
    echo '</div>'
    echo '</div>
  </div>
</div>
<script type="text/javascript">
"use strict"; (function() {
$.post("db.php", {
    mod: "view",
    name: "usercookie"
},
function(data) {
    document.getElementById("cookie").innerHTML=data;
});
});
</script>';

} else {
    header("Location: /index.php");
}
?>
