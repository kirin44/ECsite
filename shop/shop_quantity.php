<?php
session_start();
session_regenerate_id(true);

require_once("../common/common.php");

$post = sanitize($_POST);
$max = $post["max"];
$cart = $_SESSION["cart"];

for($i = 0; $i < $max; $i++) {
  if(preg_match("/\A[0-9]+\z/", $post['quan'.$i]) === 0) {
    print "正確な数を入力してください。<br><br>";
    print "<a href='shop_cartlook.php'>戻る</a>";
    exit();
  }

  if($post["quan".$i] <= 0 or $post["quan".$i] > 10) {
    print "0以上、10以下で指定してください。<br><br>";
    print "<a href='shop_cartlook.php'>戻る</a>";
    exit();
  }

  $quan[] = $post["quan".$i];
}

for($i = $max; $i >= 0; $i--) {
  if(isset($post["delete".$i])) {
    array_splice($cart, $i, 1);
    array_splice($quan, $i, 1);
  }
}

$_SESSION["cart"] = $cart;
$_SESSION["quan"] = $quan;
header("Location:shop_cartlook.php");
exit();

?>
