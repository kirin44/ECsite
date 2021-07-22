<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION["menber_login"]) === true) {
    print "ようこそ";
    print $_SESSION["menber_name"]."様";
    print "　　<a href='../manber_login/menber_logout.php'>ログアウト</a>";
    print "<br><br><br>";
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
          $disp_image = "<img src='../product/image/".$rec['image']."'>";
        }

      }

      catch(Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
      }
    ?>

    <a href="shop_cartin.php?code=<?php print $code;?>">カートに入れる</a>
    <br><br>
    <?php print $disp_image ?>
    <br>
    商品名:<?php print $rec["name"];?>
    <br>
    価格:<?php print $rec["price"];?>円
    <br>
    詳細:<?php print $rec["explanation"];?>
    <br><br>
    <form>
      <input type="button" onclick="history.back()" value="戻る">
    </form>
    <h3>カテゴリー</h3>
    <ul>
      <li><a href="shop_list_eart.php">食品</a></li>
      <li><a href="shop_list_appliance.php">家電</a></li>
      <li><a href="shop_list_book.php">書籍</a></li>
      <li><a href="shop_list_daily.php">日用品</a></li>
      <li><a href="shop_list_eart.php">その他</a></li>
    </ul>
  </body>
</html>
