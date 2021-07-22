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
    <title>商品削除実行</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    <?php
      try {

      require_once("../common/common.php");

      $post = sanitize($_POST);
      $code = $post["code"];
      $image = $post["image"];

      if(empty($image) === false) {
        unlink("./image/".$image);
      }

      $db = new PDO("mysql:host=localhost;dbname=shop", "root", "");
      $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "delete from mst_product where code=?";
      $stmt = $db -> prepare($sql);
      $data[] = $code;
      $stmt -> execute($data);

      $db = null;


      }

      catch(Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
      }
    ?>

    削除完了しました。<br><br>
    <a href="pro_list.php">商品一覧へ</a>
  </body>
</html>
