<!DOCTYPE html>
<html lang="ja">
<head>
      <link rel="stylesheet" href="../css/usertop_design.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
    	href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    	integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    	crossorigin="anonymous">

    <!-- Bootstrap Javascript(jQuery含む) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    	integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    	crossorigin="anonymous"></script>
    <script
    	src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    	integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    	crossorigin="anonymous"></script>
    <script
    	src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    	integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    	crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <title>ショッピングカートページ</title>
  <link type="text/css" rel="stylesheet" href="./css/common.css">
</head>
<body>
  <header>
        <div class="header-box">
        <?php if(@$user_name == NULL){ ?>
          <a href="./EC_shop_HOME.php">
        <?php
        }else{
        ?>
          <a href="./EC_shop_top.php">
        <?php
        }
        ?>
          <img class="logo" src="../css/css_images/rubbishbinstore_logo.png" alt="Rubbish bin STORE.com">
          </a>
          <p class="user">user：<?php
          if(@$user_name == NULL){
              print ('guest');
          }else{
              print htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8');
          }
           ?></p>
          <div class="cp_cont">
            <div class="cp_offcm01">
              <input type="checkbox" id="cp_toggle01">
              <label for="cp_toggle01"><span></span></label>
              <div class="cp_menu">
                <ul>
                <?php
                if(@$user_name == NULL){
                ?>
                <li><a href="./EC_user_login.php" class="cart"><img class="logo" src="../css/css_images/cart.png" alt="trash"></a></li>
                <?php
                }else{
				?>
                <li><a href="./EC_cart.php" class="cart"><img class="logo" src="../css/css_images/cart.png" alt="trash"></a></li>
                <?php
                }
                ?>
                <li><a href="#">商品を探す</a></li>
                <li><a href="#">FAQ</a></li>
                <?php
                if(@$user_name == NULL){
                ?>
                <li><a class="logout" href="./EC_user_login.php">ログイン</a></li>
				<li><a class="logout" href="./EC_member_regist.php">会員登録</a></li>
				<?php
                }else{
				?>
                <li><a class="logout" href="./EC_logout.php">ログアウト</a></li>
                <?php
                }
                ?>
                <li><a class="back_arr" href = 'EC_shop_HOME.php'>戻る</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    </header>
<?php
    foreach ($msg as $value) {
?>
    <p class="err-msg"><?php print htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?></p>
<?php
    }
?>
<?php
    foreach ($error as $value) {
?>
    <p class="err-msg"><?php print htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?></p>
<?php
    }
?>
<?php
    foreach ($view_data as $value) {
?>
    <ul class="cart-list">
        <li>
            <div class="cart-item">
              <img class="cart-item-img" src="./item_img/<?php print htmlspecialchars($value['img'], ENT_QUOTES, 'UTF-8'); ?>">
              <div class="cart-article">
                  <span class="cart-item-name"><?php print htmlspecialchars($value['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                  <form class="cart-item-del" action="./EC_cart.php" method="post">
                    <input type="submit" value="削除">
                    <input type="hidden" name="item_id" value="<?php print htmlspecialchars($value['item_id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="sql_kind" value="delete_cart">
                  </form>
                  <span class="cart-item-price">¥<?php print htmlspecialchars($value['price'], ENT_QUOTES, 'UTF-8'); ?></span>
                  <form class="form_select_amount" id="form_select_amount145" action="./EC_cart.php" method="post">
                    <input type="text" class="cart-item-num2" min="0" name="select_amount" value="<?php print htmlspecialchars($value['amount'], ENT_QUOTES, 'UTF-8'); ?>">個&nbsp;<input type="submit" value="変更する">
                    <input type="hidden" name="item_id" value="<?php print htmlspecialchars($value['item_id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="sql_kind" value="change_cart">
                  </form>
              </div>
            </div>
        </li>
    </ul>
<?php
}
?>
    <div class="accounting">
        <div class="buy-sum-box">
              <span class="buy-sum-title">合計</span>
              <span class="buy-sum-price">¥<?php print $cart_sum ?>円</span>
        </div>
    <?php
    if(count($error)===0){
    ?>
          <form action="./EC_finish.php" method="post">
            <input class="buy-btn" type="submit" value="購入する">
          </form>
<?php
}
?>
	</div>

    </div>

    <footer>
		<p>Copyright &copy; rubbish bin store All Rights Reserved.</p>
		<p><?php echo 'Current PHP version: ' . phpversion(); ?></>
	</footer>
</body>
</html>