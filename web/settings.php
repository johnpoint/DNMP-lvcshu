<?php
include_once 'config.php';
include_once 'verify.php';
if ( $vcode == 1) {
    echo '<div class="mdui-container doc-container doc-no-cover">
    <h1 class="doc-title mdui-text-color-theme">服务器管理面板 - 设置</h1>
    <div class="doc-chapter">
        <div class="mdui-typo">
            <div class="mdui-panel" mdui-panel>
                <div class="mdui-panel-item">
                    <div class="mdui-panel-item-header">登陆令牌</div>
                    <div class="mdui-panel-item-body">
                        <code id=\'cookie\'></code>
                        <div class="mdui-panel-item-actions">
                            <button class="mdui-btn mdui-color-theme-accent mdui-ripple" id="openedit">edit</button>
                        </div>

                        <div class="mdui-dialog" id="editcookie">
                            <div class="mdui-dialog-title">更新令牌</div>
                            <div class="mdui-dialog-content">
                                <p>令牌由用户名密码生成,更换令牌需更换密码,并且需要重新登陆</p>
                                <form>
                                    <div class="mdui-textfield mdui-textfield-floating-label">
                                        <label class="mdui-textfield-label">Username</label>
                                        <input class="mdui-textfield-input" type="text" id="editusername" />
                                    </div>
                                    <div class="mdui-textfield mdui-textfield-floating-label">
                                        <label class="mdui-textfield-label">Password</label>
                                        <input class="mdui-textfield-input" type="password" id="edituserpasswd" />
                                    </div>
                                </form>
                                <div class="mdui-dialog-actions">
                                    <button class="mdui-btn mdui-ripple" id="saveedit">save</button>
                                </div>
                            </div>
                        </div>



                        <div class="mdui-dialog" id="goodnew">
                            <div class="mdui-dialog-title">Success!</div>
                            <div class="mdui-dialog-content">操作完成</div>
                            <div class="mdui-dialog-actions">
                                <button href="/" class="mdui-btn mdui-ripple" id="okbutton" mdui-dialog-confirm>OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mdui-panel" mdui-panel>
                <div class="mdui-panel-item">
                    <div class="mdui-panel-item-header">授权码</div>
                    <div class="mdui-panel-item-body">
                        <p id=\'onepass\'></p>
                        <div class="mdui-panel-item-actions">
                            <button class="mdui-btn mdui-color-theme-accent mdui-ripple" id="addonepassb">add</button>
                        </div>
                    </div>
                </div>

                <div class="mdui-panel" mdui-panel>
                <div class="mdui-panel-item">
                    <div class="mdui-panel-item-header">API secret</div>
                    <div class="mdui-panel-item-body">
                        <p id=\'secret\'></p>
                        <div class="mdui-panel-item-actions">
                            <button class="mdui-btn mdui-color-theme-accent mdui-ripple" id="editsecret">edit</button>
                        </div>
                    </div>
                </div>

                <div class="mdui-dialog" id="editsecretwindow">
                    <div class="mdui-dialog-title">API secret</div>
                        <div class="mdui-dialog-content">
                            <p>更新 API secret</p>
                            <form>
                                <div class="mdui-textfield mdui-textfield-floating-label">
                                    <label class="mdui-textfield-label">SECRET</label>
                                    <input class="mdui-textfield-input" type="text" id="editsecrettext" />
                                </div>
                            </form>
                            <div class="mdui-dialog-actions">
                                <button class="mdui-btn mdui-ripple" id="savesecret">save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mdui-dialog" id="addonepassw">
                    <div class="mdui-dialog-title">添加授权码</div>
                    <div class="mdui-dialog-content">
                        <p>授权码由授权码以及校验码组成</p>
                        <form>
                            <div class="mdui-textfield mdui-textfield-floating-label">
                                <label class="mdui-textfield-label">校验码</label>
                                <input class="mdui-textfield-input" type="text" id="addonepassv" />
                            </div>
                            <div class="mdui-textfield mdui-textfield-floating-label">
                                <label class="mdui-textfield-label">授权码</label>
                                <input class="mdui-textfield-input" type="text" id="addonepass" />
                            </div>
                        </form>
                        <div class="mdui-dialog-actions">
                            <button class="mdui-btn mdui-ripple" id="saveonepass">save</button>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    var a = function () {
                        $.ajax({
                            url: "db.php",
                            method: "POST",
                            data: { mod: "view", name: "usercookie" },
                            success: function (data) {
                                document.getElementById("cookie").innerHTML = data;
                            }
                        })
                    };
                    var b = function () {
                        $.ajax({
                            url: "db.php",
                            method: "POST",
                            data: { mod: "view", name: "onepass" },
                            success: function (data) {
                                document.getElementById("onepass").innerHTML = data;
                            }
                        })
                    };
                    var c = function () {
                        $.ajax({
                            url: "db.php",
                            method: "POST",
                            data: { mod: "view", name: "secret" },
                            success: function (data) {
                                document.getElementById("secret").innerHTML = data;
                            }
                        })
                    };
                    a();
                    b();
                    c();
                    function c() {
                        document.getElementById("cookie").innerHTML = \'请重新登陆\';
                    };
                    var edit = new mdui.Dialog(\'#editcookie\');
var inst = new mdui.Dialog(\'#goodnew\');
var onpass = new mdui.Dialog(\'#addonepassw\');
var editsecret = new mdui.Dialog(\'#editsecretwindow\');
document.getElementById("openedit").onclick = function () {
                            edit.open();
                        }
document.getElementById("addonepassb").onclick = function () {
                            onpass.open();
                        }
                        document.getElementById("editsecret").onclick = function () {
                            editsecret.open();
                        }
document.getElementById("saveedit").onclick = function () {
                            $.ajax({
                                url: "db.php",
                                method: "POST",
                                data: { mod: "update", do: "md5", name: "usercookie", username: document.getElementById("editusername").value, userpasswd: document.getElementById("edituserpasswd").value },
                                success: function () {
                                    edit.close();
                                    inst.open();
                                    c();
                                }
                            });
                        };
                    document.getElementById("saveonepass").onclick = function () {
                        $.ajax({
                            url: "db.php",
                            method: "POST",
                            data: { mod: "add", name: "onepass", data1: document.getElementById("addonepassv").value, data2: document.getElementById("addonepass").value },
                            success: function () {
                                onpass.close();
                                inst.open();
                                b();
                            }
                        });
                    };

                    document.getElementById("savesecret").onclick = function () {
                        $.ajax({
                            url: "db.php",
                            method: "POST",
                            data: { mod: "update", name: "secret", data: document.getElementById("editsecrettext").value},
                            success: function () {
                                editsecret.close();
                                inst.open();
                                c();
                            }
                        });
                    };


                </script>';

} else {
    header("Location: /index.php");
}
?>
