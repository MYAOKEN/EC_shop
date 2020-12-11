<?php
require_once '../include/conf/const.php';
require_once '../include/model/EC_func.php';

$error = array();
$msg = array();
$user_name = '';
$passwd = '';


//$upload_res = '';

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
        //入力チェック
        check_user_name($link,$user_name);
        check_passwd($passwd);

        if(count($error) === 0){
          insert_user($link,$user_name,$passwd);
          header("Location:http://localhost:8888/EC_shop/htdocs/regist_end.php");
		   exit;
        }
    }
   // 接続を閉じます
   mysqli_close($link);
// 接続失敗した場合
} else {
   $error[] = 'DB接続失敗';
}


include_once '../include/view/EC_member_regist.php';
?>

<a href = 'EC_user_login.php'>戻る</a>