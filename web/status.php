<?php
include_once 'config.php';
include_once 'verify.php';
if ( $vcode == 1) {
echo '<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/light.css" title="light">
</style>
<div class="mdui-container doc-container doc-no-cover">
    <h1 class="doc-title mdui-text-color-theme">服务器管理面板 - 监控</h1>
    <div class="doc-chapter">
        <div class="mdui-typo">
            <div class="container content">
                <div id="loading-notice">
                    <noscript>
                        <div class="alert alert-danger" style="text-align: center;">
                            <strong>Enable JavaScript</strong>you fucking autist neckbeard, it\'s not gonna hurt you.</div>
                    </noscript>
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-warning" style="width: 100%;">Loading...</div>
                    </div>
                    <div style="text-align: center;">If this message doesn\'t disappear make sure that you have
                        Javascript enabled.
                        <br />Otherwise the status server is probably down.</div>
                    <p>
                    </p>
                </div>
                <table class="table table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th id="status4" style="text-align: center;">IPv4</th>
                            <th id="status6" style="text-align: center;">IPv6</th>
                            <th id="name">Name</th>
                            <th id="type">Type</th>
                            <th id="host">Host</th>
                            <th id="location">Location</th>
                            <th id="uptime">Uptime</th>
                            <th id="load">Load</th>
                            <th id="network">Network ↓|↑</th>
                            <th id="cpu">CPU</th>
                            <th id="ram">RAM</th>
                            <th id="disk">HDD</th>
                        </tr>
                    </thead>
                    <tbody id="servers">
                        <!-- Servers here \o/ -->
                    </tbody>
                </table>
                <br />
                <div id="updated">Updating...</div>
            </div>
            <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
            <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
            <script src="js/serverstatus.js"></script>
            <script type="text/javascript">setActiveStyleSheet(\'light\');
            </script>
        </div>
    </div>
</div>';
}else {
  header("Location: /index.php");
}
 ?>
