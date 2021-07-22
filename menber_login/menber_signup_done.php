<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>会員登録実行</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    <?php
      try {

      require_once("../common/common.php");

      $post = sanitize($_POST);

      $name = $post["name"];
      $email = $post["email"];
      $address = $post["address"];
      $tel = $post["tel"];
      $pass = $post["pass"];

      $pass = md5($pass);

      $db = new PDO("mysql:host=localhost;dbname=shop", "root", "");
      $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "select email from menber where1";
      $stmt = $db -> prepare($sql);
      $stmt -> execute();

      while(true) {
        $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
        if(empty($rec)) {
          break;
        }
        $mail[] = $rec["email"];
      }

      if(empty($mail)) {
        $mail[] = "a";
      }

      if(in_array($email, $mail)) {
        print "すでに使われているメールアドレスです。<br><br>";
        print "<a href ='menber_signup.php'>トップへ戻る</a>";
        $db = null;
      } else {
        $sql = "insert into menber(name, email, address, tel, password) values(?,?,?,?,?)";
        $stmt = $db -> prepare($sql);
        $data[] = $name;
        $data[] = $email;
        $data[] = $address;
        $data[] = $tel;
        $data[] = $pass;
        $stmt -> execute($data);

        $db = null;

        print "登録完了しました。<br><br>";
        print "<a href='../shop/shop.list.php'>トップへ戻る</a>";
      }

      }

      catch(Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='menber_login.php'>ログイン画面へ</a>";
      }
    ?>
  </body>
</html>
