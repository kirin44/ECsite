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
    <title>商品リスト</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    <?php
      try {

        $db = new PDO("mysql:host=localhost;dbname=shop", "root", "");
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT code,name,price FROM mst_product WHERE1";
        $stmt = $db -> prepare($sql);
        $stmt -> execute();

        $db = null;



        print "商品一覧<br><br>";
        print "<form action='pro_branch.php' method='post'>";

        while(true) {
          $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
          if($rec === false) {
            break;
          }
          print "<input type='radio' name='code' value='".$rec['code']."'>";
          print $rec["name"]."---".$rec["price"]."円";
          print "<br>";
        }

        print "<br>";
        print "<input type='submit' name='disp' value='詳細'>";
        print "<input type='submit' name='add' value='追加'>";
        print "<input type='submit' name='edit' value='修正'>";
        print "<input type='submit' name='delete' value='削除'>";
        print "</form>";

      }

      catch(Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='../staff/staff_login.php'>ログイン画面へ</a>";
      }

   ?>

　  <br><br>
    <a href='../staff/staff_login_top.php'>管理画面TOPへ</a>
   </body>
 </html>
