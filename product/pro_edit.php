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
        $code = $_GET["code"];

        $db = new PDO("mysql:host=localhost;dbname=shop", "root", "");
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select code,name, price, image, explanation from mst_product where code=?";
        $stmt = $db -> prepare($sql);
        $data[] = $code;
        $stmt -> execute($data);

        $db = null;

        $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

        if(empty($rec["image"]) === true) {
          $disp_image = "";
        } else {
          $disp_image = "<img src='./image/".$rec['image']."'>";
        }

      }

      catch(Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
      }
    ?>

    商品コード<br>
    <?php print $rec["code"];?>
    の情報を修正します。<br><br>
    <form action="pro_edit_check.php" method="post" enctype="multipart/form-data">
  　カテゴリー<br>
    <?php require_once("../common/common.php"); ?>
    <?php print pulldown_cate(); ?>
    <br><br>
    商品名<br>
    <input type="text" name="name" value="<?php print $rec['name'];?>">
    <br><br>
    価格<br>
    <input type="text" name="price" value="<?php print $rec['price'];?>">
    <br><br>
    画像<br>
    <?php print $disp_image; ?>
    <br>
    <input type="file" name="image">
    <br><br>
    詳細<br>
    <textarea name="comments"><?php print $rec["explanation"]; ?></textarea>
    <br><br>
    <input type="hidden" name="code" value="<?php print $rec["code"];?>">
    <input type="hidden" name="old_image" value="<?php print $rec["image"];?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
    </form>
  </body>
</html>
