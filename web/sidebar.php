<?php
echo '  <div class="mdui-drawer" id="main-drawer">
    <div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 76px;">
      <div class="mdui-collapse-item mdui-collapse-item-open">
        <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
          <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">layers</i>
          <div class="mdui-list-item-content">服务器</div>
          <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
        </div>
        <div class="mdui-collapse-item-body mdui-list">
          <a href="?page=status" class="mdui-list-item mdui-ripple ">监控</a>
          <a href="?page=cer" class="mdui-list-item mdui-ripple ">证书</a>
        </div>
      </div>
      <div class="mdui-collapse-item mdui-collapse-item-open">
        <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
          <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">widgets</i>
          <div class="mdui-list-item-content">其他</div>
          <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
        </div>
        <div class="mdui-collapse-item-body mdui-list">
          <a href="?page=settings" class="mdui-list-item mdui-ripple ">设置</a>
          <a href="?page=about" class="mdui-list-item mdui-ripple ">关于</a>
        </div>
      </div>
    </div>
    <a id="anchor-top"></a>
    <style>
      .color-palette {
        position: relative;
        padding: 0 0 36px 0;
        margin: 0;
        list-style: none;
        font-weight: 500;
        font-size: 14px;
      }

      .color-palette li {
        padding: 15px;
      }

      .color-palette .color-divider {
        margin-top: 8px;
      }

      .color-palette .main-color {}

      .color-palette .main-color .color-name {
        display: block;
        margin-bottom: 60px;
      }

      .color-palette .color-hex {
        float: right;
        text-transform: uppercase;
      }

      .color-palette .anchor-primary-color {
        position: absolute;
        top: -72px;
      }

      .color-palette .anchor-accent-color {
        position: absolute;
        top: 520px;
      }
    </style>
  </div>';
 ?>
