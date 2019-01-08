<?php
setcookie("user", "", time()-3600);
echo '<h1>成功退出！</h1>';
echo '<script type="text/javascript">
  location.href = "index.php";
</script>';
 ?>
