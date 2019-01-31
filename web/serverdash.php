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
    $info = serverDbView();
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
        echo '<tr><td id='.$i.$j.'>'.$info['info'][$i]['ipv4'].'</td>';$j++;
        echo '<tr><td id='.$i.$j.'>'.$info['info'][$i]['ipv6'].'</td>';$j++;
        echo '<tr><td id='.$i.$j.'>'.$info['info'][$i]['hostname'].'</td>';$j++;
        echo '<tr><td id='.$i.$j.'>'.$info['info'][$i]['nginx'].'</td>';$j++;
        echo '<tr><td id='.$i.$j.'>'.$info['info'][$i]['php-fpm'].'</td>';$j++;
        echo '<tr><td id='.$i.$j.'>'.$info['info'][$i]['mysql'].'</td>';$j++;
        echo '<tr><td id='.$i.$j.'>'.$info['info'][$i]['proxy'].'</td></tr>';
    }
    echo '</tbody>
    </table>
  </div>';
    echo '</div>
    </div>';
} else {
    header("Location: /index.php");
}


?>