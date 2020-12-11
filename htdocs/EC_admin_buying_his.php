<?php
session_start();
if(isset($_SESSION["user_name"]) === false){
    header("Location:http://localhost:8888/EC_shop/htdocs/EC_user_login.php");
	exit;
}


require_once '../include/conf/const.php';
require_once '../include/model/EC_func.php';

$error = array();
$msg = array();
$new_name = '';
$new_price = '';
$new_stock = '';
$new_status = '';
$new_img = '';
$sql_kind = '';


//$upload_res = '';

$link = get_db_connect();
if ($link) {
   // 文字化け防止
   mysqli_set_charset($link, 'utf8');
    // リクエストメソッド取得
    $request_method = get_request_method();

    //表示用配列の取得
    $view_data = get_buying_his_list($link);
   // 接続を閉じます
   mysqli_close($link);
// 接続失敗した場合
} else {
   $error[] = 'DB接続失敗';
}
// 新規追加テンプレートファイル読み込み
include_once '../include/view/EC_buying_tool.php';
?>