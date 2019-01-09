<?php
if ($_GET['page'] == 'settings') {
    echo '<div class="mdui-container doc-container doc-no-cover">
  <h1 class="doc-title mdui-text-color-theme">服务器管理面板 - 设置</h1>
  <div class="doc-chapter">
    <div class="mdui-typo">
    </div>
  </div>
</div>';
} else {
    header("Location: /index.php");
}
