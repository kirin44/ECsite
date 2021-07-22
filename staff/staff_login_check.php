
<?php
  try {

  require_once("../common/common.php");

  $post = sanitize($_POST);
  $code = $post["code"];
  $pass = $post["pass"];

  $pass = md5($pass);

  $db = new PDO("mysql:host=localhost;dbname=shop", "root", "");
  $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "select name from mst_staff where code=? and password=?";
  $stmt = $db -> prepare($sql);
  $data[] = $code;
  $data[] = $pass;
  $stmt -> execute($data);

  $db = null;

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);

  if (empty($rec["name"]) === true) {
    print "入力が間違っています。<br><br>";
    print "<a href='staff_login.php'>戻る</a>";
    exit();
  } else {
    session_start();
    $_SESSION["login"] = 1;
    $_SESSION["name"] = $rec["name"];
    $_SESSION["code"] = $code;
    header("Location:staff_login_top.php");
    exit();
  }

  }

  catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../staff/staff_login.php'>ログイン画面へ</a>";
  }
?>
