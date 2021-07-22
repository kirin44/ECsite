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
    <title>カート確認</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    <?php
      if(empty($_SESSION["cart"])) {
        print "カートに商品がありません。<br><br>";
        print "<a href='shop_list.php'>商品一覧へ戻る</a>";
        exit();
      }

      try {
        $cart = $_SESSION["cart"];
        $quan = $_SESSION["quan"];
        $max = count($cart);

        $db = new PDO("mysql:host=localhost;dbname=shop", "root", "");
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        foreach($cart as $key => $val) {
          $sql = "select name, price, image from mst_product where code=?";
          $stmt = $db -> prepare($sql);
          $data[0] = $val;
          $stmt -> execute($data);

          $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

          $name[] = $rec["name"];
          $price[] = $rec["price"];
          $image[] = $rec["image"];
        }

        $db = null;

      }
      catch(Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
      }
    ?>

    <form action="shop_quantity.php" method="post">
      カート一覧<br><hr><br>
      <?php
        for($i = 0; $i < $max; $i++) {
          if(empty($image[$i])) {
            $disp_image = "";
          } else {
            $disp_image = "<img src='../product/image/".$image[$i]."'>";
          }

          print $disp_image."<br><br>";
          print "商品名:".$name[$i]."<br>";
          print "価格:".$price[$i]."円<br>";
          print "数量:<input type='text' name='quan".$i."' value='".$quan[$i]."'><br>";
          print "合計価格:".$price[$i] * $quan[$i]."円<br>";
          print "削除:<input type='checkbox' name='delete".$i."'><br><hr><br>";
        }
      ?>
      <br><br>
      <input type="hidden" name="max" value="<?php print $max;?>">
      <input type="submit" value="数量変更/削除">
      <br><br>
      <input type="button" onclick="location.href='shop_list.php'" value="戻る">
    </form>
    <br><br>
    <a href="shop_form_check.php">ご購入手続きへ進む</a>
    <br>
  </body>
</html>
