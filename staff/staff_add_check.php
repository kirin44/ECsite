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
    <title>スタッフ追加チェック</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    <?php
      require_once("../common/common.php");

      $post = sanitize($_POST);
      $name = $post["name"];
      $pass = $post["pass"];
      $pass2 = $post["pass2"];

      if (empty($name) === true) {
        print "名前が入力されていません。<br><br>";
      } else {
        print $name;
        print "<br><br>";
      }

      if (empty($pass) === true) {
        print "パスワードが入力されていません。<br><br>";
      } else if ($pass != $pass2) {
        print "パスワードが異なります。<br><br>";
      }

      if (empty($name) or empty($pass) or $pass != $pass2) {
        print "<form>";
        print "<input type='button' onclick='history.back()' value='戻る'>";
        print "</form>";
      } else {
        $pass = md5($pass);
        print "上記スタッフを追加しますか？<br><br>";
        print "<form action='staff_add_done.php' method='post'>";
        print "<input type='hidden' name='name' value='".$name."'>";
        print "<input type='hidden' name='pass' value='".$pass."'>";
        print "<input type='button' onclick='history.back()' value='戻る'>";
        print "<input type='submit' value='OK'>";
        print "</form>";
      }
    ?>
  </body>
</html>
