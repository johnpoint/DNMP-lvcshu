<?php
  echo '
  <div class="mdui-container doc-container doc-no-cover">
    <h1 class="doc-title mdui-text-color-theme">服务器管理面板 - 登录</h1>
    <div class="doc-chapter">
      <div class="mdui-typo">
      <form action="vlogin.php" method="post">
      <div class="mdui-textfield mdui-textfield-floating-label">
      <label class="mdui-textfield-label">Username</label>
      <input class="mdui-textfield-input" type="text" name="user"/>
      </div>
      <div class="mdui-textfield mdui-textfield-floating-label">
      <label class="mdui-textfield-label">Password</label>
      <input class="mdui-textfield-input" type="password" name="passwd"/>
      </div>
      <input type="submit" class="mdui-btn mdui-btn-raised" value="提交">
      </form>
      </div>
    </div>
  </div>
  ';
 ?>
