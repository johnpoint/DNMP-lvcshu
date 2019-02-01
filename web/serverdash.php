<?php
include_once 'config.php';
include_once 'verify.php';
include_once 'func.php';
if ( $vcode == 1) {
    echo '<div class="mdui-container doc-container doc-no-cover">
    <h1 class="doc-title mdui-text-color-theme">服务器管理面板 - 管理</h1>
    <div class="doc-chapter">
      <div class="mdui-typo">
      <div id="serverinfo"></div>';
    $info = serverDbView('*');
    echo '<div class="mdui-table-fluid">
    <table class="mdui-table mdui-table-hoverable">';
    echo '<thead><tr>
      <th>#</th>
      <th>ipv4</th>
      <th>ipv6</th>
      <th>hostname</th>
      <th>nginx</th>
      <th>php-fpm</th>
      <th>mysql</th>
      <th>proxy</th>
    </tr></thead><tbody>';
    for($i = 0;$i <= $info['num'];$i++){
        $j = 0;
        echo '<tr><td id='.$i.$j.'>'.$info['info'][$i]['id'].'</td>';$j++;
        echo '<td id='.$i.$j.'>'.$info['info'][$i]['ipv4'].'</td>';$j++;
        echo '<td id='.$i.$j.'>'.$info['info'][$i]['ipv6'].'</td>';$j++;
        echo '<td id='.$i.$j.'>'.$info['info'][$i]['hostname'].'</td>';$j++;
        if($info['info'][$i]['nginx'] == '1'){
            echo '<td class="service" id='.$i.$j.' bgcolor="green">运行</td>';$j++;
        } else {
            echo '<td class="service" id='.$i.$j.' bgcolor="red">关闭</td>';$j++;
        }
        if($info['info'][$i]['php-fpm'] == '1'){
            echo '<td class="service" id='.$i.$j.' bgcolor="green">运行</td>';$j++;
        } else {
            echo '<td class="service" id='.$i.$j.' bgcolor="red">关闭</td>';$j++;
        }
        if($info['info'][$i]['mysql'] == '1'){
            echo '<td class="service" id='.$i.$j.' bgcolor="green">运行</td>';$j++;
        } else {
            echo '<td class="service" id='.$i.$j.' bgcolor="red">关闭</td>';$j++;
        }
        if($info['info'][$i]['proxy'] == '1'){
            echo '<td class="service" id='.$i.$j.' bgcolor="green">运行</td>';$j++;
        } else {
            echo '<td class="service" id='.$i.$j.' bgcolor="red">关闭</td>';$j++;
        }
    }
    echo '</tbody>
    </table>
  </div>';
    echo '</div>
    </div>';
    echo "<script type=\"text/javascript\">
    $('td.service').click(function () {
        this.innerHTML='等待';
        this.bgColor='yellow';
      });
    </script>";
} else {
    header("Location: /index.php");
}


?>