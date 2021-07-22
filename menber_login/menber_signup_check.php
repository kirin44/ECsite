<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>会員登録チェック</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    <?php
      require_once("../common/common.php");

      $post = sanitize($_POST);
      $name = $post["name"];
      $email = $post["email"];
      $address = $post["address"];
      $tel = $post["tel"];
      $pass = $post["pass"];
      $pass2 = $post["pass2"];
      $okflag = true;

      if (empty($name) === true) {
        print "名前が入力してください。<br><br>";
        $okflag = false;
      }

      if (empty($email) === true) {
        print "emailを入力してください。<br><br>";
        $okflag = false;
      }

      if (preg_match("/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/", $email) === 0) {
        print "正しいemailを入力してください。<br><br>";
        $okflag = false;
      }

      if (empty($address) === true) {
        print "住所を入力してください。<br><br>";
        $okflag = false;
      }

      if (empty($tel) === true) {
        print "電話番号を入力してください。<br><br>";
        $okflag = false;
      }

      if (preg_match("/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/", $tel) === 0) {
        print "正しい電話番号を入力してください。<br><br>";
        $okflag = false;
      }

      if (empty($pass) === true) {
        print "パスワードを入力してください。<br><br>";
        $okflag = false;
      }

      if ($pass != $pass2) {
        print "パスワードが異なります。<br><br>";
        $okflag = false;
      }

      if ($okflag === false) {
        print "<form>";
        print "<input type='button' onclick='history.back()' value='戻る'>";
        print "</form>";
      } else {
        print "下記内容で登録しますか？<br><br>";
        print "名前:".$name."<br><br>";
        print "メールアドレス:".$email."<br><br>";
        print "住所:".$address."<br><br>";
        print "電話番号:".$tel."<br><br>";
        print "<form action='menber_signup_done.php' method='post'>";
        print "<input type='hidden' name='name' value='".$name."'>";
        print "<input type='hidden' name='email' value='".$email."'>";
        print "<input type='hidden' name='address' value='".$address."'>";
        print "<input type='hidden' name='tel' value='".$tel."'>";
        print "<input type='hidden' name='pass' value='".$pass."'>";
        print "<input type='button' onclick='history.back()' value='戻る'>";
        print "<input type='submit' value='OK'>";
        print "</form>";
      }
    ?>
  </body>
</html>
