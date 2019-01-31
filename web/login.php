<?php
  echo '
  <div class="mdui-container doc-container doc-no-cover">
    <h1 class="doc-title mdui-text-color-theme">服务器管理面板 - 登录</h1>
    <div class="doc-chapter">
        <div class="mdui-typo">
            <form action="setcookie.php" method="post">
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">Username</label>
                    <input class="mdui-textfield-input" type="text" name="user" />
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">Password</label>
                    <input class="mdui-textfield-input" type="password" name="passwd" />
                </div>
                <input type="submit" class="mdui-btn mdui-btn-raised" value="提交">
            </form>
            <button class="mdui-btn mdui-ripple" id="onepass">授权码通道</button>
        </div>
    </div>

    <div class="mdui-dialog" id="enterpass">
        <div class="mdui-dialog-title">授权码登陆</div>
        <div class="mdui-dialog-content">
            <p>授权码仅能使用一次！</p>
            <form>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">校验码</label>
                    <input class="mdui-textfield-input" type="text" id="oneuser" />
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">授权码</label>
                    <input class="mdui-textfield-input" type="text" id="onepasstext" />
                </div>
            </form>
            <div class="mdui-dialog-actions">
                <button class="mdui-btn mdui-ripple" id="enter">提交</button>
            </div>
            <script type="text/javascript">
                var onepass = new mdui.Dialog(\'#enterpass\');
    document.getElementById("onepass").onclick = function () {
                        onepass.open();
                    };
            </script>
        </div>
    </div>
</div>
  ';
 ?>
