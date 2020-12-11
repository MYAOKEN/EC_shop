<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>EC_shop_admin</title>
    <style>
        section {
            margin-bottom: 20px;
            border-top: solid 1px;
        }

        table {
            width: 660px;
            border-collapse: collapse;
        }

        table, tr, th, td {
            border: solid 1px;
            padding: 10px;
            text-align: center;
        }

        caption {
            text-align: left;
        }

        .text_align_right {
            text-align: right;
        }

        .drink_name_width {
            width: 100px;
        }

        .input_text_width {
            width: 60px;
        }

        .status_false {
            background-color: #A9A9A9;
        }
    </style>
</head>
<body>
    <div>
    <a class="nemu" href="./EC_logout.php">ログアウト</a>
    <a href="./EC_tool.php">商品管理ページ</a>
    <a href="./EC_admin_user.php">ユーザー管理ページ</a>
  </div>
    <h1>EC_shop 管理ページ</h1>
<?php
    foreach ($msg as $value) {
?>

    <p><?php print $value; ?></p>

<?php
}
?>
<?php
    foreach ($error as $value) {
?>

    <p><?php print $value; ?></p>

<?php
}
?>
    <section>
        <h2>購入履歴</h2>
        <table>
        <tr>
          <th>ユーザID</th>
          <th>商品ID</th>
          <th>購入数</th>
          <th>購入日時</th>
        </tr>
<?php
foreach ($view_data as $value) {
?>
        <tr>
          <td><?php print htmlspecialchars($value['user_id'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td><?php print htmlspecialchars($value['item_id'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td><?php print htmlspecialchars($value['amount'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td><?php print htmlspecialchars($value['buying_day'], ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
<?php
}
?>
        </table>
    </section>
</body>
</html>
