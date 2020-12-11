<!DOCTYPE html>
<html lang="ja">
<head>
<!-- CSS -->
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

<!-- Flexslider -->
<link rel="stylesheet" href="./FLEX_SLIDER/flexslider.css"
	type="text/css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="./FLEX_SLIDER/jquery.flexslider.js"></script>
<script type="text/javascript" charset="utf-8">
    $(window).load(function() {
    	  $('.flexslider').flexslider({
    	    animation: "slide",
    	    controlNav: "thumbnails",
    	    maxItems: 1,
    	    itemWidth: 500
    	  });
    	});
    </script>

<meta charset="utf-8">
<meta name='viewport' content='width=device-width,initial-scale=1.0'>
<title>shop_top</title>

</head>
<body>
	<header>
		<div class="header-box img_rap col-xs-12 col-lg-12">
			<a href="./EC_shop_HOME.php"> <img class="top-logo"
				src="../css/css_images/rubbishbinstore_logo.png"
				alt="Rubbish bin STORE.com">
			</a>
			<p class="user">user：<?php
if (@$user_name == NULL) {
    print('guest');
} else {
    print htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8');
}
?></p>
			<div class="cp_cont">
				<div class="cp_offcm01">
					<input type="checkbox" id="cp_toggle01"> <label for="cp_toggle01"><span></span></label>
					<div class="cp_menu">
						<ul>
							<?php
    if (@$user_name == NULL) {
        ?>
                            <li><a href="./EC_user_login.php"
								class="cart"><img class="logo" src="../css/css_images/cart.png"
									alt="trash"></a></li>
                            <?php
    } else {
        ?>
                            <li><a href="./EC_cart.php" class="cart"><img
									class="logo" src="../css/css_images/cart.png" alt="trash"></a></li>
                            <?php
    }
    ?>
							<li><a href="#">商品を探す</a></li>
							<li><a href="#">FAQ</a></li>
							<?php
    if (@$user_name == NULL) {
        ?>
                            <li><a class="logout"
								href="./EC_user_login.php">ログイン</a></li>
							<li><a class="logout" href="./EC_member_regist.php">会員登録</a></li>
            				<?php
    } else {
        ?>
                            <li><a class="logout" href="./EC_logout.php">ログアウト</a></li>
                            <?php
    }
    ?>
							<li><a class="back_arr" href=''>戻る</a></li>
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
    <p class="err-msg"><?php print $value; ?></p>
<?php
}
?>

 <p class="err-msg"><?php print $comment; ?></p>

<?php
foreach ($view_data as $value) {
    ?>




<div class="container-fluid">

		<div class="row item_main">

			<div class="img_rap col-xs-12 col-lg-7 flexslider">
				<ul class="slides">
					<li
						data-thumb="./item_img/<?php print htmlspecialchars($value['img'], ENT_QUOTES, 'UTF-8'); ?>">
						<img
						src="./item_img/<?php print htmlspecialchars($value['img'], ENT_QUOTES, 'UTF-8'); ?>" />
					</li>
            <?php
    if ($value['img2'] != NULL) {
        ?>
            <li
						data-thumb="./item_img/<?php print htmlspecialchars($value['img2'], ENT_QUOTES, 'UTF-8'); ?>">
						<img
						src="./item_img/<?php print htmlspecialchars($value['img2'], ENT_QUOTES, 'UTF-8'); ?>" />
					</li>
            <?php
    }
    if ($value['img3'] != NULL) {
        ?>
            <li
						data-thumb="./item_img/<?php print htmlspecialchars($value['img3'], ENT_QUOTES, 'UTF-8'); ?>">
						<img
						src="./item_img/<?php print htmlspecialchars($value['img3'], ENT_QUOTES, 'UTF-8'); ?>" />
					</li>
            <?php
    }
    if ($value['img4'] != NULL) {
        ?>
    		<li
						data-thumb="./item_img/<?php print htmlspecialchars($value['img4'], ENT_QUOTES, 'UTF-8'); ?>">
						<img
						src="./item_img/<?php print htmlspecialchars($value['img4'], ENT_QUOTES, 'UTF-8'); ?>" />
					</li>
            <?php
    }
    if ($value['img5'] != NULL) {
        ?>
    		<li
						data-thumb="./item_img/<?php print htmlspecialchars($value['img5'], ENT_QUOTES, 'UTF-8'); ?>">
						<img
						src="./item_img/<?php print htmlspecialchars($value['img5'], ENT_QUOTES, 'UTF-8'); ?>" />
					</li>
            <?php
    }
    ?>
          </ul>
			</div>

			<div class="article col-xs-12 col-lg-5">
				<h2 class="item_name"><?php print htmlspecialchars($value['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
				<h2 class="price">¥<?php print htmlspecialchars($value['price'], ENT_QUOTES, 'UTF-8'); ?></h2>
			<?php if($_POST['stock'] > 0){ ?>
	                <span class="stock_ex">在庫数有</span>
	              <?php } else { ?>
	                <span class="out_of_stock">売り切れ</span>
	        <?php } ?>
	        <p class="article_text"><?php print htmlspecialchars($value['article'], ENT_QUOTES, 'UTF-8'); ?></p>
				<form action="" method="post" class="insert_to_cart">
					<span>注文数<input class="" type="text" name="amount" value=""></span>
					<input class="cart-btn" type="submit" value="カートに入れる"> <input
						type="hidden" name="stock"
						value="<?php print htmlspecialchars($value['stock'], ENT_QUOTES, 'UTF-8'); ?>">
					<input type="hidden" name="item_id"
						value="<?php print htmlspecialchars($value['item_id'], ENT_QUOTES, 'UTF-8'); ?>">
					<input type="hidden" name="sql_kind" value="insert_cart">
				</form>
			</div>
		</div>

<?php
}
?>
</div>
	<footer>
		<p>Copyright &copy; rubbish bin store All Rights Reserved.</p>
		<p><?php echo 'Current PHP version: ' . phpversion(); ?></>
	</footer>
</body>

</html>