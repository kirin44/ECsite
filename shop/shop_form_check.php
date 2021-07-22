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

        $menber_code = $_SESSION["menber_code"];
        $cart = $_SESSION["cart"];
        $quan = $_SESSION["quan"];
        $max = count($quan);

        $db = new PDO("mysql:host=localhost;dbname=shop", "root", "");
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT name, email, address, tel FROM menber where code=?";
        $stmt = $db -> prepare($sql);
        $data[] = $menber_code;
        $stmt -> execute($data);

        $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

        $name = $rec["name"];
        $email = $rec["email"];
        $address = $rec["address"];
        $tel = $rec["tel"];

        print "下記内容でよろしいでしょうか？<br><br>";
        print "【宛先】<br>";
        print "お名前:".$name;
        print "<br>";
        print "mail:".$email;
        print "<br>";
        print "ご住所:".$address;
        print "<br>";
        print "ご連絡先:".$tel;
        print "<br><br><br>";

        print "【ご注文内容】<br>";

        $all_price = 0;

        for($i = 0; $i < $max; $i++) {
          $sql = "SELECT name, price, image FROM mst_product where code=?";
          $stmt = $db -> prepare($sql);
          $data = array();
          $data[] = $cart[$i];
          $stmt -> execute($data);

          $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

          if(empty($rec["image"])) {
            $disp_image = "";
          } else {
            $disp_image = "<img src='../product/image/".$rec['image']."'>";
          }

          print "<br>";
          print $disp_image;
          print "<br><br>";
          print "商品名:".$rec["name"];
          print "<br>";
          print "価格:".$rec["price"]."円";
          print "<br>";
          print "数量:".$quan[$i];
          print "<br>";
          print "合計金額:".$rec["price"] * $quan[$i]."円";
          print "<br><br>";

          $all_price += $rec["price"] * $quan[$i];
        }

        $db = null;

        print "【ご請求金額】　".$all_price."円";
        print "<br><br>";
        print "<form action='shop_form_done.php' method='post'>";
        print "<input type='hidden' name='name' value='".$name."'>";
        print "<input type='hidden' name='email' value='".$email."'>";
        print "<input type='hidden' name='address' value='".$address."'>";
        print "<input type='hidden' name='tel' value='".$tel."'>";
        print "<input type='button' onclick='history.back()' value='戻る'>";
        print "<input type='submit' value='OK'><br>";
        print "</form>";

      }

      catch(Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='../menber_login/menber_login.php'>ログイン画面へ</a>";
      }

   ?>

   </body>
 </html>
