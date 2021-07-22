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
  <form action="staff_add_check.php" method="post">
  　スタッフ追加<br><br>
    スタッフ名<br>
    <input type="text" name="name">
    <br><br>
    パスワード<br>
    <input type="password" name="pass">
    <br><br>
    パスワード再入力<br>
    <input type="password" name="pass2">
    <br><br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
  </form>
</body>
</html>
