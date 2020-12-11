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
$comment ='';
$error = array();

$link = get_db_connect();
if ($link) {
   // 文字化け防止
   mysqli_set_charset($link, 'utf8');
   // リクエストメソッド取得
    $request_method = get_request_method();
    // POSTの場合
    if ($request_method === 'POST') {
        $sql_kind = get_post_data('sql_kind');
        if($sql_kind === 'post_item'){
            //ポストデータを取得
            $item_id = get_post_data('item_id');
            $amount = get_post_data('amount');
            $stock = get_post_data('stock');
            check_amount($amount);
            if($stock >= $amount){
                if(count($msg) === 0){
                    //商品をカートに入れる
                    insert_cart($link,$item_id,$user_name,$amount,$stock);
                    if(count($msg) === 0){
                        $comment = 'カートに追加しました';
                    }
                }
            }else{
                $msg[] = 'カートに入れる数は在庫数以下にしてください';
            }
        }
    }
   //表示データ取得
   $view_data = get_product_data_list_display($link);
   //var_dump($view_data);
   // 接続を閉じます
   mysqli_close($link);
// 接続失敗した場合
} else {
   print 'DB接続失敗';
}


// 新規追加テンプレートファイル読み込み
include_once '../include/view/EC_HOME.php';
?>
