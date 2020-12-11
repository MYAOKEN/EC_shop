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
    <a href="./EC_admin_user.php">ユーザ管理ページ</a>
    <a href="./EC_admin_buying_his.php">購入履歴</a>
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
        <h2>新規商品追加</h2>
        <form method="post" enctype="multipart/form-data">
            <div><label>名前: <input type="text" name="new_name" value="" placeholder="スペースのみ不可"><font color="red">＊入力必須</font></label></div>
            <div><label>値段: <input type="text" name="new_price" value="" placeholder="半角数字で1以上"><font color="red">＊入力必須</font></label></div>
            <div><label>個数: <input type="text" name="new_stock" value="" placeholder="半角数字で1以上"><font color="red">＊入力必須</font></label></div>
            <div><label>記事: <textarea rows="4" cols="40e1
            ZT" type="text" name="new_article" placeholder="200文字以内"></textarea></label></div>
            <div>TOP画像：<input type="file" name="new_img[]"><font color="red">＊入力必須</font></div>
            <div>サブ画像：<input type="file" name="new_img[]"></div>
            <div>サブ画像：<input type="file" name="new_img[]"></div>
            <div>サブ画像：<input type="file" name="new_img[]"></div>
            <div>サブ画像：<input type="file" name="new_img[]"></div>
            <div>
                <select name="new_status">
                    <option value="0">非公開</option>
                    <option value="1">公開</option>
                </select>
            </div>
            <input type="hidden" name="sql_kind" value="insert">
            <div><input type="submit" value="■□■□■商品追加■□■□■"></div>
        </form>
    </section>
    <section>
        <h2>商品情報変更</h2>
        <table>
            <caption>商品一覧</caption>
            <tr>
                <th>商品画像1</th>
                <th>商品画像2</th>
                <th>商品画像3</th>
                <th>商品画像4</th>
                <th>商品画像5</th>
                <th>商品名</th>
                <th>価格</th>
                <th>記事</th>
                <th>在庫数</th>
                <th>ステータス</th>
                <th>操作</th>
            </tr>
             <?php
foreach ($view_data as $value) {
?>
            <tr class="<?php if(htmlspecialchars($value['status'], ENT_QUOTES, 'UTF-8') === "0"){print 'status_false';} ?>">
                <form method="post">
                    <td><img src="./item_img/<?php print $value['img']; ?>"></td>
                    <td><img src="./item_img/<?php print $value['img2']; ?>"></td>
                    <td><img src="./item_img/<?php print $value['img3']; ?>"></td>
                    <td><img src="./item_img/<?php print $value['img4']; ?>"></td>
                    <td><img src="./item_img/<?php print $value['img5']; ?>"></td>
                    <td><?php print htmlspecialchars($value['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php print htmlspecialchars($value['price'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php print htmlspecialchars($value['article'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><input type="text"  class="input_text_width text_align_right" name="update_stock" value="<?php print htmlspecialchars($value['stock'], ENT_QUOTES, 'UTF-8'); ?>">個&nbsp;&nbsp;<input type="submit" value="変更"></td>
                    <input type="hidden" name="item_id" value="<?php print htmlspecialchars($value['item_id'], ENT_QUOTES, 'UTF-8'); ?>" >
                    <input type="hidden" name="sql_kind" value="update">
                </form>
                <form method="post">
                    <td><input type="submit" value="公開 → 非公開"></td>
                    <input type="hidden" name="change_status" value="<?php print htmlspecialchars($value['status'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="item_id" value="<?php print htmlspecialchars($value['item_id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="sql_kind" value="change">
                </form>
                <form method="post">
                  <td><input type="submit" value="削除する"></td>
                  <input type="hidden" name="item_id" value="<?php print htmlspecialchars($value['item_id'], ENT_QUOTES, 'UTF-8'); ?>">
                  <input type="hidden" name="sql_kind" value="delete">
                </form>
            <tr>
                <?php
}
?>
        </table>
    </section>
</body>
</html>
