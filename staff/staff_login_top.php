<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='staff_login.php'>ログイン画面へ</a>";
    exit();
} else {
    print $_SESSION["name"]."さんログイン中";
    print "<br><br>";
}

 ?>



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>スタッフ追加</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
  管理画面TOP<br><br>
  <a href="staff_list.php">スタッフ管理</a>
  <br><br>
  <a href="../product/pro_list.php">商品管理</a>
  <br><br>
  <a href="staff_logout.php">ログアウト</a>
</body>
</html>
