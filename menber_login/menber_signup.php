<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>メンバーログイン入力</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    新規会員登録画面<br><br>
    <form action="menber_signup_check.php" method="post">
      お名前<br>
      <input type="text" name="name">
      <br><br>
      email<br>
      <input type="text" name="email">
      <br><br>
      住所<br>
      <input type="text" name="address">
      <br><br>
      tel<br>
      <input type="text" name="tel">
      <br><br>
      パスワード<br>
      <input type="password" name="pass">
      <br><br>
      パスワード再入力<br>
      <input type="password" name="pass2">
      <br><br><br>
      <input type="button" onclick="history.back()" value="戻る">
      <input type="submit" value="OK">
    </form>
  </body>
</html>
