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
<title>商品追加</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
  <form action="pro_add_check.php" method="post" enctype="multipart/form-data">
    商品追加<br><br>
    カテゴリー<br>
    <?php require_once("../common/common.php"); ?>
    <?php print pulldown_cate(); ?>
    <br><br>
    商品名<br>
    <input type="text" name="name">
    <br><br>
    価格<br>
    <input type="text" name="price">
    <br><br>
    画像<br>
    <input type="file" name="image">
    <br><br>
    詳細<br>
    <textarea name="comments"></textarea>
    <br><br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
  </form>
</body>
</html>
