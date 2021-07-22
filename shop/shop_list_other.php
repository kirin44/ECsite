<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION["menber_login"]) === true) {
    print "ようこそ";
    print $_SESSION["menber_name"]."様";
    print "　　<a href='../menber_login/menber_logout.php'>ログアウト</a>";
    print "<br><br><br>";
} else {
  print "<a href='../menber_login/menber_login.php'>ログイン</a><br><br><br>";
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ECサイトTOP(book)</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    <?php
      try {

        $db = new PDO("mysql:host=localhost;dbname=shop", "root", "");
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT code,name,price,image,explanation FROM mst_product where category=?";
        $stmt = $db -> prepare($sql);
        $data[] = "その他";
        $stmt -> execute($data);

        $db = null;

        print "販売商品一覧";
        print "　<a href='shop_cartlook.php'>カートを見る</a>";
        print "<br><br><hr><br>";

        while(true) {
          $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
          if($rec === false) {
            break;
          }

          if(empty($rec["image"]) === true) {
            $image = "";
          } else {
            $image = "<img src='../product/image/".$rec['image']."'>";
          }

          print "<a href='shop_product.php?code=".$rec['code']."'>";
          print $image;
          print "<br><br>";
          print "商品名:".$rec["name"];
          print "<br>";
          print "価格:".$rec["price"];
          print "<br>";
          print "詳細:".$rec["explanation"];
          print "</a>";
          print "<br><br><hr><br>";
        }

        print "<br>";
        print "<a href='shop_list.php'>トップページへ</a>";

      }

      catch(Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='../shop/shop_list.php'>TOP画面へ</a>";
      }

   ?>

    <br><br><br>
    <h3>カテゴリー</h3>
    <ul>
      <li><a href="shop_list_food.php">食品</a></li>
      <li><a href="shop_list_appliance.php">家電</a></li>
      <li><a href="shop_list_book.php">書籍</a></li>
      <li><a href="shop_list_daily.php">日用品</a></li>
      <li><a href="shop_list_other.php">その他</a></li>
    </ul>
   </body>
 </html>
