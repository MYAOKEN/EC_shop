<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>購入完了ページ</title>
  <link type="text/css" rel="stylesheet" href="./css/common.css">
</head>
<body>
  <header>
    <div class="header-box">
      <a href="./EC_shop_top.php">
        <img class="logo" src="./images/logo.png" alt="CodeCamp SHOP">
      </a>
      <a class="nemu" href="./EC_logout.php">ログアウト</a>
      <a href="./EC_cart.php" class="cart"></a>
      <p class="nemu">ユーザー名：<?php print htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
  </header>
  <a href = 'EC_cart.php'>戻る</a>
  <div class="content">
<?php
foreach($error as $value){
?>
  <p class="err-msg"><?php print htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?></p>
<?php
}
?>

    <div class="finish-msg"><?php print htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?></div>
    <div class="cart-list-title">
      <span class="cart-list-price">価格</span>
      <span class="cart-list-num">数量</span>
    </div>
<?php
    foreach ($view_data as $value) {
?>
    <ul class="cart-list">
        <li>
            <div class="cart-item">
              <img class="cart-item-img" src="./item_img/<?php print htmlspecialchars($value['img'], ENT_QUOTES, 'UTF-8'); ?>">
              <span class="cart-item-name"><?php print htmlspecialchars($value['name'], ENT_QUOTES, 'UTF-8'); ?></span>
              <form class="cart-item-del" action="./EC_cart.php" method="post">
                <!--<input type="submit" value="削除">-->
                <input type="hidden" name="item_id" value="<?php print htmlspecialchars($value['item_id'], ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="sql_kind" value="delete_cart">
              </form>
              <span class="cart-item-price">¥<?php print htmlspecialchars($value['price'], ENT_QUOTES, 'UTF-8'); ?></span>
              <form class="form_select_amount" id="form_select_amount145" action="./EC_cart.php" method="post">
                <span class="cart-item-num2"><?php print htmlspecialchars($value['amount'], ENT_QUOTES, 'UTF-8'); ?>個&nbsp;</span>
                <input type="hidden" name="item_id" value="<?php print htmlspecialchars($value['item_id'], ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="sql_kind" value="change_cart">
              </form>
            </div>
        </li>
    </ul>
<?php
}
?>
    <div class="buy-sum-box">
      <span class="buy-sum-title">合計</span>
      <span class="buy-sum-price">￥<?php print htmlspecialchars($cart_sum, ENT_QUOTES, 'UTF-8'); ?></span>
    </div>
  </div>
</body>
</html>