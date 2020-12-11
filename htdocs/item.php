<?php


require_once '../include/conf/const.php';
require_once '../include/model/EC_func.php';


$item_id = '';
$amount = '';
$msg = array();
$comment ='';
$error = array();


$link = get_db_connect();

if(isset($_POST)){
    $item_id = $_POST['item_id'];
    $view_data = get_select_product($link,$item_id);
}


if ($link) {
   // 文字化け防止
   mysqli_set_charset($link, 'utf8');
   // リクエストメソッド取得
    $request_method = get_request_method();
    // POSTの場合
    if ($request_method === 'POST') {
        $sql_kind = get_post_data('sql_kind');
        if($sql_kind === 'insert_cart'){
            $msg[] = 'ログインしてください';
        }
    }

   // 接続を閉じます
   mysqli_close($link);
// 接続失敗した場合
} else {
   print 'DB接続失敗';
}


// 新規追加テンプレートファイル読み込み
include_once '../include/view/item_intoroduce.php';
?>
