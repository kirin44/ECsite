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
    <title>スタッフ修正チェック</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    <?php
      require_once("../common/common.php");

      $post = sanitize($_POST);
      $code = $post["code"];
      $name = $post["name"];
      $price = $post["price"];
      $image = $_FILES["image"];
      $old_image = $post['old_image'];
      $comments = $post["comments"];
      $cate = $post["cate"];

      print "商品コード<br>";
      print $code." の情報を修正します。<br><br>";

      if (empty($name) === true) {
        print "名前が入力されていません。<br><br>";
      } else {
        print "商品名:".$name;
        print "<br><br>";
      }

      if (empty($price) === true) {
        print "価格が入力されていません。<br><br>";
      } else if(preg_match("/\A[0-9]+\z/", $price) === 0) {
        print "正しい値を入力してください。";
        print "<br><br>";
      } else {
        print "価格:".$price."円";
        print "<br><br>";
      }

      if($image["size"] > 0) {
        if($image["size"] > 1000000) {
          print "ファイルのサイズが大きすぎます。";
          print "<br><br>";
        } else {
          move_uploaded_file($image["tmp_name"],"./image/".$image["name"]);
          print "<img src='./image/".$image['name']."'>";
          print "<br><br>";
        }
      }

      if($image["name"] === "") {
        if($old_image != "") {
          print "<img src='./image/".$old_image."'>";
          print "<br><br>";
        }
      }

      if (mb_strlen($comments) > 100) {
        print "文字数上限は100文字です。<br><br>";
      } else {
        print "詳細:".$comments;
        print "<br><br>";
      }

      if (empty($name) or empty($price) or preg_match("/\A[0-9]+\z/", $price) === 0 or $image["size"] > 1000000 or mb_strlen($comments) > 100) {
        print "<form>";
        print "<input type='button' onclick='history.back()' value='戻る'>";
        print "</form>";
      } else {
        print "上記の通り修正しますか？<br><br>";
        print "<form action='pro_edit_done.php' method='post'>";
        print "<input type='hidden' name='cate' value='".$cate."'>";
        print "<input type='hidden' name='code' value='".$code."'>";
        print "<input type='hidden' name='name' value='".$name."'>";
        print "<input type='hidden' name='price' value='".$price."'>";
        print "<input type='hidden' name='image' value='".$image['name']."'>";
        print "<input type='hidden' name='old_image' value='".$old_image."'>";
        print "<input type='hidden' name='comments' value='".$comments."'>";
        print "<input type='button' onclick='history.back()' value='戻る'>";
        print "<input type='submit' value='OK'>";
        print "</form>";
      }
    ?>
  </body>
</html>
