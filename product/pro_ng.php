<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='staff_login.html'>ログイン画面へ</a>";
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
<title>商品選択NG</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
  商品が選択されていません。<br><br>
  <a href="pro_list.php">商品一覧に戻る</a>
</body>
</html>
