<?php
session_start();
if(isset($_SESSION["user_name"]) === false){
    header("Location:http://localhost:8888/EC_shop/htdocs/EC_user_login.php");
	exit;
}

require_once '../include/conf/const.php';
require_once '../include/model/EC_func.php';

$user_name = $_SESSION["user_name"];
$item_id = '';
$amount = '';
$msg = array();
$sum = 0;
$error = array();

$link = get_db_connect();
if ($link) {
   // 文字化け防止
   mysqli_set_charset($link, 'utf8');
   // リクエストメソッド取得
    $request_method = get_request_method();

    if ($request_method === 'POST') {
        $sql_kind = get_post_data('sql_kind');
        if($sql_kind === 'change_cart'){
            //ポストデータを取得
            $item_id = get_post_data('item_id');
            $select_amount = get_post_data('select_amount');
            check_amount($select_amount);
            if(count($msg) === 0){
                update_cart($link,$item_id,$user_name,$select_amount);
            }
        }
        if($sql_kind === 'delete_cart'){
            //ポストデータを取得
            $item_id = get_post_data('item_id');
            delete_cart_item($link,$item_id,$user_name);
        }
    }
    //カートの商品有無
    check_cart($link,$user_name);
    //カート内商品の合計金額
    $cart_sum = get_cart_price($link,$user_name);
   //表示データ取得
   $view_data = get_cart_list($link,$user_name);
//   $price_array = array_column($view_data, 'price');
   // 接続を閉じます
   mysqli_close($link);
// 接続失敗した場合
} else {
   print 'DB接続失敗';
}
// 新規追加テンプレートファイル読み込み
include_once '../include/view/EC_cart_top.php';
?>
