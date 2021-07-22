<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>会員ログインチェック</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    <?php
      require_once("../common/common.php");

      $post = sanitize($_POST);
      $email = $post["email"];
      $pass = $post["pass"];
      $pass2 = $post["pass2"];
      $okflag = true;

      if (empty($email) === true) {
        print "emailを入力してください。<br><br>";
        $okflag = false;
      }

      if (preg_match("/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/", $email) === 0) {
        print "正しいemailを入力してください。<br><br>";
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
        print "下記メールアドレスでログインしますか？<br><br>";
        print $email."<br><br>";
        print "<form action='menber_login_done.php' method='post'>";
        print "<input type='hidden' name='email' value='".$email."'>";;
        print "<input type='hidden' name='pass' value='".$pass."'>";
        print "<input type='button' onclick='history.back()' value='戻る'>";
        print "<input type='submit' value='OK'>";
        print "</form>";
      }
    ?>
  </body>
</html>
