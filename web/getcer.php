<?php
include_once 'config.php';
if ($_COOKIE["user"] == $usercookie) {
    echo '<div class="mdui-panel" mdui-panel>';
    function listDir($dir)
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
                        listDir($dir."/".$file);
                    } else {
                        if ($file != "." && $file != "..") {
                            echo '<div class="mdui-panel" mdui-panel>';
                            echo '<div class="mdui-panel-item">';
                            echo '<div class="mdui-panel-item-header">'.'<div class="mdui-panel-item-title">'.$file.'</div>'.'<i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>'.'</div>';
                            echo '<div class="mdui-panel-item-body">';
                            echo 'wget https://center.lvcshu.com/getcerfile.php?file='.$dir.'/'.$myfile.$file;
                            echo '<br>';
                            echo 'curl https://center.lvcshu.com/getcerfile.php?file='.$dir.'/'.$myfile.$file;
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
    listDir("ssl");
    echo '</div></div></div></div>';
} else {
    header("Location: /index.php");
}
