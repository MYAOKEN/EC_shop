<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>shop_top</title>
    <link type="text/css" rel="stylesheet" href="./css/common.css">
    </style>
</head>
<body>
<header>
        <div class="header-box">
          <a href="./EC_shop_top.php">
            <img class="logo" src="./images/logo.png" alt="CodeCamp SHOP">
          </a>
          <!--<a class="nemu" href="./EC_logout.php">ログアウト</a>-->
          <a href="./EC_cart.php" class="cart"></a>
          <!--<p class="nemu">ユーザー名：<?php print htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8'); ?></p>-->
        </div>
</header>
<?php
    foreach ($error as $value) {
?>

    <p><?php print $value; ?></p>

<?php
    }
?>
   <form action="" method="post">
       <p>
           <label for="mail">メールアドレス: </label>
           <input type="email" name="mail" id="mail">
       </p>
        <p>
           <label for="user">ユーザー名: </label>
           <input type="text" name="user_name" id="user_name">
       </p>
       <p>
           <label for="password">パスワード: </label>
           <input type="password" name="passwd" id="password">
       </p>
       <p>
           メール配信:
           <label><input type="checkbox" name="magazine" value="1"  checked>配信を希望する</label>
       </p>
       <p>
           <input type="submit" name="regist" value="登録">
       </p>
   </form>
</body>
</html>