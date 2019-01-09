<?php
include_once 'config.php';
if ($_COOKIE["user"] == md5($username.$userpasswd)) {
  echo '<div class="mdui-container doc-container doc-no-cover">
    <h1 class="doc-title mdui-text-color-theme">服务器管理面板 - 证书分发</h1>
    <div class="doc-chapter">
      <div class="mdui-typo">';
    echo '<div class="mdui-panel" mdui-panel>';
    function listDir($dir,$cookie)
    {
        if (is_dir($dir)) {
            //打开目录句柄
            if ($dh = opendir($dir)) {
                //从目录句柄中读取条目
                while (($file = readdir($dh)) !== false) {
                    if (is_dir($dir."/".$file) && $file!="." && $file!="..") {
                        echo '<div class="mdui-panel-item">';
                        echo '<div class="mdui-panel-item-header">'.$file.'</div>';
                        echo '<div class="mdui-panel-item-body">';
                        listDir($dir."/".$file,$cookie);
                    } else {
                        if ($file != "." && $file != "..") {
                            echo '<div class="mdui-panel" mdui-panel>';
                            echo '<div class="mdui-panel-item">';
                            echo '<div class="mdui-panel-item-header">'.'<div class="mdui-panel-item-title">'.$file.'</div>'.'<i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>'.'</div>';
                            echo '<div class="mdui-panel-item-body">';
                            echo '<p> wget https://center.lvcshu.com/getcerfile.php?file='.$dir.'/'.$myfile.$file.' -H \'cookie: user='.$cookie."'".'</p>';
                            echo '<p> curl https://center.lvcshu.com/getcerfile.php?file='.$dir.'/'.$myfile.$file.' -H \'cookie: user='.$cookie."'".'</p>';
                            echo "<a href=".'\'https://center.lvcshu.com/getcerfile.php?file='.$dir.'/'.$myfile.$file."'".'class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">Download</a>';
                            echo '</div></div>';
                        }
                    }
                }
                closedir($dh);
            }
        } else {
            echo $dir . '<br>';
        }
    }
    listDir("ssl",$usercookie);
    echo '</div></div></div></div>';
    echo '</div>
      </div>
    </div>';
} else {
    header("Location: /index.php");
}
