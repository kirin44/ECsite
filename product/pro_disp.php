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
    <title>商品詳細</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    <?php
      try {
        $code = $_GET["code"];

        $db = new PDO("mysql:host=localhost;dbname=shop", "root", "");
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select category, code, name, price, image, explanation from mst_product where code=?";
        $stmt = $db -> prepare($sql);
        $data[] = $code;
        $stmt -> execute($data);

        $db = null;

        $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

        $image = $rec["image"];

        if(empty($image) === true) {
          $disp_image = "";
        } else {
          $disp_image = "<img src='./image/".$image."'>";
        }

      }

      catch(Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
      }
    ?>

    商品詳細<br><br>
    商品コード<br>
    <?php print $rec["code"];?>
    <br><br>
    カテゴリー<br>
    <?php print $rec['category'];?>
    <br><br>
    商品名<br>
    <?php print $rec['name'];?>
    <br><br>
    商品名<br>
    <?php print $rec['price']."円";?>
    <br><br>
    <?php print $disp_image;?>
    <br><br>
    詳細<br>
    <?php print $rec['explanation'];?>
    <br><br>
    <input type="button" onclick="history.back()" value="戻る">
  </body>
</html>
