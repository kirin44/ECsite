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
    <title>商品追加実行</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    <?php
      try {

      require_once("../common/common.php");

      $post = sanitize($_POST);
      $code = $post["code"];
      $name = $post["name"];
      $price = $post["price"];
      $image = $post["image"];
      $old_image = $post["old_image"];
      $comments = $post["comments"];
      $cate = $post["cate"];

      if(empty($image) && isset($old_image) === true) {
        $image = $old_image;
      }

      if($old_image != "") {
        if($image != $old_image) {
          unlink("./image/".$old_image);
        }
      }

      $db = new PDO("mysql:host=localhost;dbname=shop", "root", "");
      $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "update mst_product set category=?, name=?, price=?, image=?, explanation=? where code=?";
      $stmt = $db -> prepare($sql);
      $data[] = $cate;
      $data[] = $name;
      $data[] = $price;
      $data[] = $image;
      $data[] = $comments;
      $data[] = $code;
      $stmt -> execute($data);

      $db = null;


      }

      catch(Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
      }
    ?>

    修正を完了しました。<br><br>
    <a href="pro_list.php">商品一覧へ</a>
  </body>
</html>
