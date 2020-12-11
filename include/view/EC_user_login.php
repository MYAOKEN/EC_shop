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
    <title>shop_top</title>
    <link type="text/css" rel="stylesheet" href="./css/common.css">
    </style>
</head>
<body>
<header>
        <div class="header-box">
          <a href="./EC_shop_HOME.php">
          <img class="logo" src="../css/css_images/rubbishbinstore_logo.png" alt="Rubbish bin STORE.com">
          </a>
        </div>
    </header>
<?php

?>
<?php
    foreach ($error as $value) {
?>

    <p><?php print $value; ?></p>

<?php
    }
?>


<form class="id_pw_box" action="" method="POST">
    <!--<h2>EC_shopログインページ</h2>-->
	<p>ログインID：<input type="text" name="user_name"></p>
	<p>パスワード：<input type="password" name="passwd"></p>
	<p><input type="submit" name="login" value="ログイン">←会員登録済の方</p>
	<p><input type="submit" name="regist" value="新規会員登録" action = "EC_member_regist.php"></p>
</form>
</body>