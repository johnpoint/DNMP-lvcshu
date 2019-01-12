<?php
include_once 'config.php';
include_once 'verify.php';
if ( $vcode == 1) {
    echo '<div class="mdui-panel" mdui-panel>';
    function listDir($dir)
    {
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
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
?>
