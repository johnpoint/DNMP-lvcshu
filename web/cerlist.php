<?php
echo '<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/mdui/0.4.2/css/mdui.min.css">';
echo '<script src="//cdnjs.cloudflare.com/ajax/libs/mdui/0.4.2/js/mdui.min.js"></script>';
echo '<div class="mdui-panel mdui-panel-gapless" mdui-panel>';
if(is_dir("./data")) {
    //打开目录句柄
    if ($dh = opendir("./data")) {
        //从目录句柄中读取条目
        while (($file = readdir($dh)) !== false) {
            if(is_dir("./data"."/".$file) && $file!="." && $file!="..") {
                echo "<b><font color='red'>文件名：</font></b>",$file,"<br><hr>";
                listDir("./data"."/".$file."/");
            }
            else {
                if($file != "." && $file != "..") {
                  echo '<div class="mdui-panel-item">';
                    echo '<div class="mdui-panel-item-header">'.'<div class="mdui-panel-item-title">'.$file.'</div>'.'<i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>'.'</div>';
                    echo '<div class="mdui-panel-item-body">';
                    $myfile = fopen("data/$file", "r") or die("Unable to open file!");
                    while(!feof($myfile)) {
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
    echo "./data" . '<br>';
}
echo '</div>';
?>
