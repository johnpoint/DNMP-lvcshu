<?php
include_once 'config.php';
if ($_COOKIE["user"] == md5($username.$userpasswd)) {
    echo '<div class="mdui-panel" mdui-panel>';
    function listDir($dir)
    {
        if (is_dir($dir)) {
            //打开目录句柄
            if ($dh = opendir($dir)) {
                //从目录句柄中读取条目
                while (($file = readdir($dh)) !== false) {
                    if (is_dir($dir."/".$file) && $file!="." && $file!="..") {
                        echo "<b><font color='red'>文件名：</font></b>",$file,"<br><hr>";
                        listDir($dir."/".$file."/");
                    } else {
                        if ($file != "." && $file != "..") {
                            echo '<div class="mdui-panel-item">';
                            echo '<div class="mdui-panel-item-header">'.'<div class="mdui-panel-item-title">'.$file.'</div>'.'<i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>'.'</div>';
                            echo '<div class="mdui-panel-item-body">';
                            $myfile = fopen("$dir/$file", "r") or die("Unable to open file!");
                            while (!feof($myfile)) {
                                echo '<p>'.fgets($myfile) . '</p>';
                            }
                            echo '</div></div>';
                            fclose($myfile);
                        }
                    }
                }
                closedir($dh);
            }
        } else {
            echo $dir . '<br>';
        }
    }
    listDir("./data");
    echo '</div>';
} else {
    echo 'error';
}
