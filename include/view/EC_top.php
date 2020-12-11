<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="../css/usertop_design.css">
      <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- Bootstrap Javascript(jQuery含む) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width,initial-scale=1.0'>
    <title>shop_top</title>
    </style>
</head>
<body>
    <header>
        <div class="header-box">
          <a href="./EC_shop_top.php">
          <img class="logo" src="../css/css_images/rubbishbinstore_logo.png" alt="Rubbish bin STORE.com">
          </a>
          <p class="user">user：<?php print htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8'); ?></p>
          <div class="cp_cont">
            <div class="cp_offcm01">
              <input type="checkbox" id="cp_toggle01">
              <label for="cp_toggle01"><span></span></label>
              <div class="cp_menu">
                <ul>
                <li><a href="./EC_cart.php" class="cart"><img class="logo" src="../css/css_images/cart.png" alt="trash"></a></li>
                <li><a href="#">商品を探す</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a class="logout" href="./EC_logout.php">ログアウト</a></li>
                <li><a class="back_arr" href = './EC_cart.php'>戻る</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    </header>


    <!--<a class="nemu" href="./EC_logout.php">ログアウト</a>-->
    <!--<form method="post" name="form_cart" action="./EC_cart.php">-->
    <!--<a href="./EC_cart.php" class="cart" ></a>-->
    <!--</form>-->
<?php
    foreach ($msg as $value) {
?>
    <p class ="err-msg"><?php print $value; ?></p>
<?php
}
?>

 <p class ="err-msg"><?php print $comment; ?></p>

 <div class="container-fluid">
 <div class="row">
    <?php
        foreach ($view_data as $value) {
    ?>

    <div class="img_rap col-xs-12 col-lg-3">
        <ul class="item-list">
              <li>
                <div class="item">
                  <form name="go_name" action="item.php" method="post">
                    <input type="image" src="./item_img/<?php print htmlspecialchars($value['img'], ENT_QUOTES, 'UTF-8'); ?>" class="sub_btn img_dev">
                    <div class="item-info">
                      <span class="item-name"><?php print htmlspecialchars($value['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                      <span class="item-price">¥<?php print htmlspecialchars($value['price'], ENT_QUOTES, 'UTF-8'); ?></span>
                      <?php if($value['stock'] > 0){ ?>
                        <span class="">在庫数有</span>
                      <?php } else { ?>
                        <span class="">売り切れ</span>
                      <?php } ?>
                    </div>
                    <!--  <span>注文数<input class="" type="text" name="amount" value=""></span> -->
                    <!--  <input class="cart-btn" type="submit" value="カートに入れる"> -->
                    <input type="hidden" name="stock" value="<?php print htmlspecialchars($value['stock'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="item_id" value="<?php print htmlspecialchars($value['item_id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="sql_kind" value="post_item">
                  </form>
                </div>
              </li>
        </ul>
      </div>


    <!--<form action="" method="post">-->
    <!--    <div id="flex">-->
    <!--            <div class="item">-->
    <!--                <span class="img_size"><img src="./item_img/<?php print htmlspecialchars($value['img'], ENT_QUOTES, 'UTF-8'); ?>"></span>-->
    <!--                <span><?php print htmlspecialchars($value['name'], ENT_QUOTES, 'UTF-8'); ?></span>-->
    <!--                <span>¥<?php print htmlspecialchars($value['price'], ENT_QUOTES, 'UTF-8'); ?></span>-->
    <!--                <?php if($value['stock'] > 0){ ?>-->
    <!--                <span>在庫数<?php print htmlspecialchars($value['stock'], ENT_QUOTES, 'UTF-8'); ?></span>-->
    <!--                <?php } else { ?>-->
    <!--                <span class="red">売り切れ</span>-->
    <!--                <?php } ?>-->
    <!--                <input class="" type="text" name="amount" value=""> -->
    <!--                <input class="cart-btn" type="submit" value="カートに入れる">-->
    <!--                <input type="hidden" name="stock" value="<?php print htmlspecialchars($value['stock'], ENT_QUOTES, 'UTF-8'); ?>">-->
    <!--                <input type="hidden" name="item_id" value="<?php print htmlspecialchars($value['item_id'], ENT_QUOTES, 'UTF-8'); ?>">-->
    <!--                <input type="hidden" name="sql_kind" value="insert_cart">-->
    <!--            </div>-->
    <!--    </div>-->
    <!--</form>-->
    <?php
        }
    ?>
    </div>

</div>
</body>
</html>