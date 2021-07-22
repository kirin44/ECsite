<?php
  session_start();
  $_session = array();

  if (isset($_cookie[session_name()]) === true) {
    setcookie(session_name(), "", time()-42000, "/");
  }

  session_destroy();

 ?>



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ログアウト</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
  ログアウトしました。<br><br>
  <a href="../shop/shop_list.php">TOPへ</a>
</body>
</html>
