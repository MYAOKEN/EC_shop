<?php
session_start();

$error = array();

require_once '../include/conf/const.php';
require_once '../include/model/EC_func.php';

//ユーザーログイン
$link = get_db_connect();
if ($link) {
   // 文字化け防止
   mysqli_set_charset($link, 'utf8');
    // リクエストメソッド取得
    $request_method = get_request_method();
    // POSTの場合
    if ($request_method === 'POST') {
        //↓新規商品データの追加処理
        //ポストデータを取得
        $user_name = get_post_data('user_name');
        $passwd = get_post_data('passwd');
        //入力チェック（ユーザー名,パスワードの登録確認）
        check_user_regist($link,$user_name,$passwd);
        if(count($error) === 0){
        $_SESSION["user_name"] = $_POST["user_name"];
		$login_success_url = "EC_shop_top.php";
		header("Location:http://localhost:8888/EC_shop/htdocs/EC_shop_top.php");
		exit;
        }
    }
   // 接続を閉じます
   mysqli_close($link);
// 接続失敗した場合
} else {
   $error[] = 'DB接続失敗';
}

//管理者用ログイン
if(isset($_POST["login"])) {
	if($_POST["user_name"] == "admin" && $_POST["passwd"] == "admin") {
		$_SESSION["user_name"] = $_POST["user_name"];
		$login_success_url = "EC_tool.php";
		header("Location:http://localhost:8888/EC_shop/htdocs/EC_tool.php");
		exit;
	}
}

//会員登録ページへ移動
if(isset($_POST["regist"])){
    	header("Location:http://localhost:8888/EC_shop/htdocs/EC_member_regist.php");
		exit;
}

include_once '../include/view/EC_user_login.php';
?>