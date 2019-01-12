<?php
if ($_POST['do'] == 'md5') {
  echo md5($_POST['text']);
} elseif ($_POST['do'] == 'base64') {
  echo base64_encode($_POST['text']);
} elseif ($_POST['do'] == 'uuid') {
  function create_uuid($prefix = ""){
    $str = md5(uniqid(mt_rand(), true));
    $uuid  = substr($str,0,8) . '-';
    $uuid .= substr($str,8,4) . '-';
    $uuid .= substr($str,12,4) . '-';
    $uuid .= substr($str,16,4) . '-';
    $uuid .= substr($str,20,12);
    return $prefix . $uuid;
}
    echo create_uuid();
} else {
  echo '<div class="mdui-container doc-container doc-no-cover">
  <h1 class="doc-title mdui-text-color-theme">服务器管理面板 - 常用工具</h1>
  <div class="doc-chapter">
  <div class="mdui-typo">';

  echo '<div class="mdui-panel" mdui-panel>';
  echo '<div class="mdui-panel-item  ">';
  echo '<div class="mdui-panel-item-header">MD5 / BASE64</div>';
  echo '<div class="mdui-panel-item-body">';
  echo '<div class="mdui-textfield">
    <label class="mdui-textfield-label">Text</label>
    <input class="mdui-textfield-input" type="text" id="text"/>
  </div>
  <code id=\'result\'></code>
  <div class="mdui-panel-item-actions">
      <button class="mdui-btn mdui-color-theme-accent mdui-ripple" id="getmd5">md5</button>
      <button class="mdui-btn mdui-color-theme-accent mdui-ripple" id="getbase64">base64</button>
    </div>';

  echo '</div></div></div>
<script type="text/javascript">
  document.getElementById("getmd5").onclick = function(){
    $.ajax({
      url: "tool.php",
      method:"POST",
      data:{do: "md5", text: document.getElementById("text").value},
      success: function(data){
        document.getElementById("result").innerHTML = data;
      }
    });
  };

  document.getElementById("getbase64").onclick = function(){
    $.ajax({
      url: "tool.php",
      method:"POST",
      data:{do: "base64", text: document.getElementById("text").value},
      success: function(data){
        document.getElementById("result").innerHTML = data;
      }
    });
  };
  </script>';

  echo '<div class="mdui-panel" mdui-panel>';
  echo '<div class="mdui-panel-item  ">';
  echo '<div class="mdui-panel-item-header">UUID</div>';
  echo '<div class="mdui-panel-item-body">';
  echo '
  <code id=\'getuuid\'></code>
  <div class="mdui-panel-item-actions">
      <button class="mdui-btn mdui-color-theme-accent mdui-ripple" id="switch">switch</button>
    </div></div></div></div>';

  echo '
<script type="text/javascript">
  document.getElementById("switch").onclick = function(){
    $.ajax({
      url: "tool.php",
      method:"POST",
      data:{do: "uuid"},
      success: function(data){
        document.getElementById("getuuid").innerHTML = data;
      }
    });
  };
  </script>';

  echo '<div class="mdui-panel" mdui-panel>';
  echo '<div class="mdui-panel-item  ">';
  echo '<div class="mdui-panel-item-header">IP 查询</div>';
  echo '<div class="mdui-panel-item-body">';
  echo '<div class="mdui-textfield">
    <label class="mdui-textfield-label">IP address</label>
    <input class="mdui-textfield-input" type="text" id="ipaddr"/>
  </div>
  <p id="country"></p>
  <p id="city"></p>
  <p id="organization"></p>
  <div class="mdui-panel-item-actions">
      <button class="mdui-btn mdui-color-theme-accent mdui-ripple" id="getip">GET</button>
    </div></div></div></div>
    <script type="text/javascript">
      document.getElementById("getip").onclick = function(){
        $.ajax({
          url: "https://api.ip.sb/geoip/"+document.getElementById("ipaddr").value,
          method:"GET",
          success: function(data){
            document.getElementById("country").innerHTML = "国家: " + data["country"];
            document.getElementById("city").innerHTML =  "城市: " + data["city"];
            document.getElementById("organization").innerHTML =  "组织: " + data["organization"];
          }
        });
      };
    </script>';
}
 ?>
