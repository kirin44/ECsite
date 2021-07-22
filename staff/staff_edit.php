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
    <title>スタッフ追加実行</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    <?php
      try {
        $code = $_GET["code"];

        $db = new PDO("mysql:host=localhost;dbname=shop", "root", "");
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select code,name from mst_staff where code=?";
        $stmt = $db -> prepare($sql);
        $data[] = $code;
        $stmt -> execute($data);

        $db = null;

        $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

      }

      catch(Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
      }
    ?>

    スタッフコード<br>
    <?php print $rec["code"];?>
    の情報を修正します。<br><br>
    <form action="staff_edit_check.php" method="post">
  　スタッフ名<br>
    <input type="text" name="name" value="<?php print $rec['name'];?>">
    <br><br>
    パスワード<br>
    <input type="password" name="pass">
    <br><br>
    パスワード再入力<br>
    <input type="password" name="pass2">
    <br><br>
    <input type="hidden" name="code" value="<?php print $rec["code"];?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
    </form>
  </body>
</html>
