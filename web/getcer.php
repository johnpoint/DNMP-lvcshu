<?php
include_once 'config.php';
include_once 'verify.php';
if ( $vcode == 1) {
  echo '<div class="mdui-container doc-container doc-no-cover">
    <h1 class="doc-title mdui-text-color-theme">服务器管理面板 - 证书分发</h1>
    <div class="doc-chapter">
      <div class="mdui-typo">';
    echo '<div class="mdui-panel" mdui-panel>';
    function listDir($dir,$cookie)
    {
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if (is_dir($dir."/".$file) && $file!="." && $file!="..") {
                        echo '<div class="mdui-panel-item">';
                        echo '<div class="mdui-panel-item-header">'.$file.'</div>';
                        echo '<div class="mdui-panel-item-body">';
                        listDir($dir."/".$file,$cookie);
                    } else {
                        if ($file != "." && $file != ".." && $file != "synccer.sh") {
                            echo '<div class="mdui-panel" mdui-panel>';
                            echo '<div class="mdui-panel-item">';
                            echo '<div class="mdui-panel-item-header">'.'<div class="mdui-panel-item-title">'.$file.'</div>'.'<i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>'.'</div>';
                            echo '<div class="mdui-panel-item-body">';
                            echo '<pre> curl https://center.lvcshu.com/getcerfile.php?file='.$dir.'/'.$myfile.$file.' -H \'cookie: user='.$_COOKIE["user"]."'"." > $file".'</pre>';
                            echo "<a href=".'\'https://center.lvcshu.com/getcerfile.php?file='.$dir.'/'.$myfile.$file."'".'class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">View</a>';
                            echo '</div></div>';
                        }
                    }
                }
                echo '</div></div></div></div>';
                closedir($dh);
            }
        } else {
            echo $dir . '<br>';
        }
    }
    listDir("ssl",$usercookie);
    echo '</div>
      </div>
    </div>';
} else {
    echo 'error';
}
?>
