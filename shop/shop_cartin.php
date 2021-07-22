<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION["menber_login"])) {
    print "ようこそ";
    print $_SESSION["menber_name"]."様";
    print "　　<a href='../manber_login/menber_logout.php'>ログアウト</a>";
    print "<br><br><br>";
} else {
  print "ログインしてください。<br><br>";
  print "<a href='../menber_login/menber_login.php'>ログイン画面へ</a><br><br>";
  print "<a href='shop_list.php'>TOP画面へ</a>";
  exit();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>商品選択</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    <?php
        $code = $_GET["code"];

        if(isset($_SESSION["cart"])) {
          $cart = $_SESSION["cart"];
          $quan = $_SESSION["quan"];

          if(in_array($code, $cart)) {
            print "すでにカート内にあります。<br><br>";
            print "<a href='shop_list.php'>商品一覧へ戻る</a>";
          }
        }

        if(empty($_SESSION["cart"]) === true or in_array($code, $cart) === false) {
          $cart[] = $code;
          $quan[] = 1;
          $_SESSION["cart"] = $cart;
          $_SESSION["quan"] = $quan;

          print "カートに追加しました。<br><br>";
          print "<a href='shop_list.php'>商品一覧へ戻る</a><br><br>";
        }


    ?>

  </body>
</html>
