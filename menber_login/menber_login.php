<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>メンバーログイン入力</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    会員情報を入力してください。<br><br>
    <form action="menber_login_check.php" method="post">
      メールアドレス<br>
      <input type="text" name="email">
      <br><br>
      パスワード<br>
      <input type="password" name="pass">
      <br><br>
      パスワード再入力<br>
      <input type="password" name="pass2">
      <br><br><br>
      <input type="button" onclick="history.back()" value="戻る">
      <input type="submit" value="OK">
      <br><br>
      会員情報が未登録の方はこちらから登録お願いします。<br>
      <a href="menber_signup.php">新規会員登録はこちら</a>
    </form>
  </body>
</html>
