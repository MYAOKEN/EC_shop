<?php
session_start();
if(isset($_SESSION["user_name"]) === false){
    header("Location:http://localhost:8888/EC_shop/htdocs/EC_user_login.php");
	exit;
}

require_once '../include/conf/const.php';
require_once '../include/model/EC_func.php';

$user_name = $_SESSION["user_name"];
$error = array();
$msg = '';


$link = get_db_connect();
if ($link) {
    // 文字化け防止
    mysqli_set_charset($link, 'utf8');
    // リクエストメソッド取得
    $request_method = get_request_method();
    $cart_row = get_cart_list($link,$user_name);
    $cart_sum = get_cart_price($link,$user_name);
    check_item_stock($link,$user_name);
    //エラー数のカウント
    if(count($error) === 0){
        mysqli_autocommit($link,false);
        if(buy($link,$user_name) === true){
            $view_data = get_cart_list($link,$user_name);
            controll_stock($link,$user_name);
            delete_cart($link,$user_name);
            $msg = '購入ありがとうございました';
        }else{
            $error[] = '購入履歴の更新に失敗しました';
        }
        if(count($error) === 0){
            mysqli_commit($link);
        }else{
            mysqli_rollback($link);
        }
    }
   // 接続を閉じます
   mysqli_close($link);
// 接続失敗した場合
} else {
   $error[] = 'DB接続失敗';
}
//var_dump($error);
include_once '../include/view/EC_buy.php';
?>