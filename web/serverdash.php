<?php
include_once 'config.php';
include_once 'verify.php';
include_once 'func.php';
if ( $vcode == 1) {
    echo '<div class="mdui-container doc-container doc-no-cover">
    <h1 class="doc-title mdui-text-color-theme">服务器管理面板 - 管理</h1>
    <div class="doc-chapter">
      <div class="mdui-typo">
      <div style="display: none;" id="nonediv"></div>
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
            echo '<td item="nginx" class="service" id='.$i.$j.' bgcolor="green" ip='.$info['info'][$i]['ipv4'].'>运行</td>';$j++;
        } elseif ($info['info'][$i]['nginx'] == '10') {
            echo '<td item="nginx" class="service" id='.$i.$j.' bgcolor="yellow" ip='.$info['info'][$i]['ipv4'].'>关闭中</td>';$j++;
        } elseif ($info['info'][$i]['nginx'] == '11') {
            echo '<td item="nginx" class="service" id='.$i.$j.' bgcolor="yellow" ip='.$info['info'][$i]['ipv4'].'>开启中</td>';$j++;
        } else {
            echo '<td item="nginx" class="service" id='.$i.$j.' bgcolor="red" ip='.$info['info'][$i]['ipv4'].'>关闭</td>';$j++;
        }

        if($info['info'][$i]['phpfpm'] == '1'){
            echo '<td item="phpfpm" class="service" id='.$i.$j.' bgcolor="green" ip='.$info['info'][$i]['ipv4'].'>运行</td>';$j++;
        } elseif ($info['info'][$i]['phpfpm'] == '10') {
            echo '<td item="phpfpm" class="service" id='.$i.$j.' bgcolor="yellow" ip='.$info['info'][$i]['ipv4'].'>关闭中</td>';$j++;
        } elseif ($info['info'][$i]['phpfpm'] == '11') {
            echo '<td item="phpfpm" class="service" id='.$i.$j.' bgcolor="yellow" ip='.$info['info'][$i]['ipv4'].'>开启中</td>';$j++;
        } else {
            echo '<td item="phpfpm" class="service" id='.$i.$j.' bgcolor="red" ip='.$info['info'][$i]['ipv4'].'>关闭</td>';$j++;
        }

        if($info['info'][$i]['mysql'] == '1'){
            echo '<td item="mysql" class="service" id='.$i.$j.' bgcolor="green" ip='.$info['info'][$i]['ipv4'].'>运行</td>';$j++;
        } elseif ($info['info'][$i]['mysql'] == '10') {
            echo '<td item="mysql" class="service" id='.$i.$j.' bgcolor="yellow" ip='.$info['info'][$i]['ipv4'].'>关闭中</td>';$j++;
        } elseif ($info['info'][$i]['mysql'] == '11') {
            echo '<td item="mysql" class="service" id='.$i.$j.' bgcolor="yellow" ip='.$info['info'][$i]['ipv4'].'>开启中</td>';$j++;
        } else {
            echo '<td item="mysql" class="service" id='.$i.$j.' bgcolor="red" ip='.$info['info'][$i]['ipv4'].'>关闭</td>';$j++;
        }

        if($info['info'][$i]['proxy'] == '1'){
            echo '<td item="proxy" class="service" id='.$i.$j.' bgcolor="green" ip='.$info['info'][$i]['ipv4'].'>运行</td>';$j++;
        } elseif ($info['info'][$i]['proxy'] == '10') {
            echo '<td item="proxy" class="service" id='.$i.$j.' bgcolor="yellow" ip='.$info['info'][$i]['ipv4'].'>关闭中</td>';$j++;
        } elseif ($info['info'][$i]['proxy'] == '11') {
            echo '<td item="proxy" class="service" id='.$i.$j.' bgcolor="yellow" ip='.$info['info'][$i]['ipv4'].'>开启中</td>';$j++;
        } else {
            echo '<td item="proxy" class="service" id='.$i.$j.' bgcolor="red" ip='.$info['info'][$i]['ipv4'].'>关闭</td>';$j++;
        }
    }
    echo '</tbody>
    </table>
  </div>';
    echo '</div>
    </div>';
    echo "<script type=\"text/javascript\">
    var c = function () {
        $.ajax({
            url: 'db.php',
            method: 'POST',
            data: { mod: 'view', name: 'secret' },
            success: function (data) {
                $('#nonediv').innerHTML=data;
            }
        })
    };
    c();
    $('td.service').click(function () {
        hitpoint=this;
        if ( this.bgColor == 'green' ){
            $.ajax({
                url:'api.php',
                method: 'GET',
                data: {do:'repo',ipv4:this.attributes['4'].nodeValue,key:this.attributes['0'].nodeValue,value:'10',secret:secretda},
                success: function () {
                    hitpoint.bgColor='yellow';
                    hitpoint.innerHTML='关闭中';
                }
            });
        } else {
            $.ajax({
                url:'api.php',
                method: 'GET',
                data: {do:'repo',ipv4:this.attributes['4'].nodeValue,key:this.attributes['0'].nodeValue,value:'11',secret:secretda},
                success: function () {
                    hitpoint.bgColor='yellow';
                    hitpoint.innerHTML='开启中';
                }
            });
        }
      });
    </script>";
} else {
    header("Location: /index.php");
}


?>