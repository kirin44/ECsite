<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ログイン入力</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>
    スタッフログイン<br><br>
    <form action="staff_login_check.php" method="post">
      スタッフコード<br>
      <input type="text" name="code">
      <br><br>
      パスワード<br>
      <input type="password" name="pass">
      <br><br>
      <input type="submit" value="OK">
    </form>
  </body>
</html>
