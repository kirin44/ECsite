<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>会員ログイン実行</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    <?php
      try {

        require_once("../common/common.php");
        $post = sanitize($_POST);

        $email = $post["email"];
        $pass = $post["pass"];

        $pass = md5($pass);

        $db = new PDO("mysql:host=localhost;dbname=shop", "root", "");
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select code, name from menber where email=? and password=?";
        $stmt = $db -> prepare($sql);
        $data[] = $email;
        $data[] = $pass;
        $stmt -> execute($data);

        $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

        $db = null;

        if(empty($rec["name"])) {
          print "ログイン情報が間違っています。<br>";
          print "<a href='menber_login.php'>戻る</a>";
          exit();
        }

        session_start();
        $_SESSION["menber_login"] = 1;
        $_SESSION["menber_name"] = $rec["name"];
        $_SESSION["menber_code"] = $rec["code"];
        print "ログインしました。<br><br>";
        print "<a href='../shop/shop_list.php'>トップへ戻る</a>";

      }

      catch(Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='menber_login.php'>ログイン画面へ</a>";
      }
    ?>
  </body>
</html>
