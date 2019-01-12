<?php
include_once 'config.php';
if ($_COOKIE["user"] == md5($username.$userpasswd)) {
    echo '<div class="mdui-container doc-container doc-no-cover">
  <h1 class="doc-title mdui-text-color-theme">服务器管理面板 - 设置</h1>
  <div class="doc-chapter">
    <div class="mdui-typo">';
    echo '<div class="mdui-panel" mdui-panel>';
    echo '<div class="mdui-panel-item">';
    echo '<div class="mdui-panel-item-header">唯一令牌</div>';
    echo '<div class="mdui-panel-item-body">';
    echo '<code id=\'cookie\'></code>';
    echo '<div class="mdui-panel-item-actions">
        <button class="mdui-btn mdui-color-theme-accent mdui-ripple" id="openedit">edit</button>
      </div>

      <div class="mdui-dialog" id="editcookie">
    <div class="mdui-dialog-title">更新令牌</div>
    <div class="mdui-dialog-content">
    <p>令牌与用户名密码生成,更换令牌需更换密码</p>
    <form>
    <div class="mdui-textfield mdui-textfield-floating-label">
    <label class="mdui-textfield-label">Username</label>
    <input class="mdui-textfield-input" type="text" id="editusername"/>
    </div>
    <div class="mdui-textfield mdui-textfield-floating-label">
    <label class="mdui-textfield-label">Password</label>
    <input class="mdui-textfield-input" type="password" id="edituserpasswd"/>
    </div>
    </form>
    <div class="mdui-dialog-actions">
    <button class="mdui-btn mdui-ripple" id="saveedit">save</button>
    </div>
      </div>
      </div>

    <div class="mdui-dialog" id="goodnew">
    <div class="mdui-dialog-title">Success!</div>
    <div class="mdui-dialog-content">令牌已经更改</div>
    <div class="mdui-dialog-actions">
      <button class="mdui-btn mdui-ripple" id="ping" mdui-dialog-confirm>OK</button>
    </div>



  </div>';
    echo '</div>';
    echo '</div>';
    echo '</div>
  </div>
</div>
<script type="text/javascript">
var a = function() {
	$.ajax({
    url: "db.php",
    method:"POST",
    data:{mod:"view",name:"usercookie"},
    success:function(data){
    result = data;
    document.getElementById("cookie").innerHTML = data;
    }})
};
a();
var edit = new mdui.Dialog(\'#editcookie\');
var inst = new mdui.Dialog(\'#goodnew\');
document.getElementById("openedit").onclick = function(){
  edit.open();
}

document.getElementById("saveedit").onclick = function(){
  $.ajax({
    url: "db.php",
    method:"POST",
    data:{mod:"update",do: "md5",name: "usercookie",username: document.getElementById("editusername").value ,userpasswd: document.getElementById("edituserpasswd").value},
    success: function(){
      edit.close();
      inst.open();
    }
  });
};

document.getElementById("ping").onclick = function() {
	$.ajax({
    url: "db.php",
    method:"POST",
    data:{mod:"view",name:"usercookie"},
    success:function(data){
    result = data;
    document.getElementById("cookie").innerHTML = data;
    }})
};
</script>';

} else {
    header("Location: /index.php");
}
?>
