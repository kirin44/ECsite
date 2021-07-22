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
    <title>ECサイトTOP</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    <?php
      try {

        require_once("../common/common.php");

        $post = sanitize($_POST);

        $menber_name = $post["name"];
        $email = $post["email"];
        $address = $post["address"];
        $tel = $post["tel"];
        $cart = $_SESSION["cart"];
        $quan = $_SESSION["quan"];
        $max = count($cart);

        print $menber_name."様<br>";
        print "ご注文ありがとうございました。<br>";
        print $email."にメールを送りましたのでご確認ください。<br>";
        print "商品は入金を確認次第、下記の住所へ発送させていただきます。<br>";
        print $address;
        print "<br>";
        print $tel;
        print "<br>";

        $db = new PDO("mysql:host=localhost;dbname=shop", "root", "");
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $all_price = 0;
        $order = "";

        for($i = 0; $i < $max; $i++) {
          $sql = "SELECT name, price FROM mst_product where code=?";
          $stmt = $db -> prepare($sql);
          $data[0] = $cart[$i];
          $stmt -> execute($data);

          $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

          $name = $rec["name"];
          $price = $rec["price"];
          $product_price[] = $price;
          $product_quan = $quan[$i];
          $total = $price * $product_quan;

          $order .= $name."　".$price."円×".$product_quan."=".$total."円\n";

          $all_price += $total;

        }

        $sql = "lock tables dat_sales_product write";
        $stmt = $db -> prepare($sql);
        $stmt -> execute();

        for($i = 0; $i < $max; $i++) {
          $sql = "insert into dat_sales_product(sales_menber_code, code_product, price, quantity, time) values(?,?,?,?,now())";
          $stmt = $db -> prepare($sql);
          $data = array();
          $data[] = $_SESSION["menber_code"];
          $data[] = $cart[$i];
          $data[] = $product_price[$i];
          $data[] = $quan[$i];
          $stmt -> execute($data);
        }

        $sql = "unlock tables";
        $stmt = $db -> prepare($sql);
        $stmt -> execute();

        $db = null;

        $email_text = $menber_name."様
                      この度はご注文いただきありがとうございます。<br>
                      ご注文内容<br>---------------<br>".$order."
                      合計金額:".$all_price."円<br>
                      送料は無料です。
                      -------------<br>
                      代金は以下の口座にお振込み下さい。
                      A銀行　B支店　普通口座　1234567<br>
                      入金が確認取れ次第、商品を発送させていただきます。<br>
                      ◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆
                      　～ショップ～
                      東京都aaaaaa
                      電話　090-0000-0000
                      メール　aaa@mail.com
                      ◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆<br>";

        print nl2br($email_text);

        $title = "ご注文ありがとうございます。";
        $header = "From:aaa@mail.com";
        $email_text = html_entity_decode($email_text, ENT_QUOTES, "UTF-8");
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        mb_send_mail($email, $title, $email_text, $header) ;

        $title = "お客様よりご注文が入りました。";
        $header = "From:".$email;
        $email_text = html_entity_decode($email_text, ENT_QUOTES, "UTF-8");
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        mb_send_mail("aaa@mail.com", $title, $email_text, $header) ;

      }

      catch(Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='../menber_login/menber_login.php'>ログイン画面へ</a>";
      }

      $_SESSION["cart"] = array();
      $_SESSION["quan"] = array();

   ?>

    <br>
    <a href="shop_list.php">商品一覧へ</a>
   </body>
 </html>
