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
$new_article = '';
$new_img = array(NULL,NULL,NULL,NULL,NULL);
$new_img2 = '';
$new_img3 = '';
$new_img4 = '';
$new_img5 = '';
$sql_kind = '';


//$upload_res = '';

$link = get_db_connect();
if ($link) {
   // 文字化け防止
   mysqli_set_charset($link, 'utf8');
    // リクエストメソッド取得
    $request_method = get_request_method();
    // POSTの場合
    if ($request_method === 'POST') {
        $sql_kind = get_post_data('sql_kind');
        if($sql_kind === 'insert'){
            //↓新規商品データの追加処理
            //ポストデータを取得
            $new_name = get_post_data('new_name');
            $new_price = get_post_data('new_price');
            $new_stock = get_post_data('new_stock');
            $new_status = get_post_data('new_status');
            $new_article = get_post_data('new_article');
            //↓画像アップロード↓


            // ファイルがあれば処理実行
            if(isset($_FILES["new_img"])){
                // アップロードされたファイル件を処理
                for($i = 0; $i < count($_FILES["new_img"]["name"]); $i++){
                    if(get_file_datalp("new_img",$i)){
                        $new_img[$i] = get_file_datalp('new_img',$i);
                        upload_imglp("new_img",$i,$new_img[$i]);
                    }
                }
            }
            //check_file_data("new_img");
            /*
            if(get_file_data('new_img')){
                $new_img = get_file_data('new_img');
                upload_img('new_img',$new_img);
            }

            check_file_data('new_img');
            */
            check_name($new_name);
            check_price($new_price);
            check_stock($new_stock);
            //入力チェック
            if(count($error) === 0){
                //トランザクション処理
                mysqli_autocommit($link,false);
                //product_dataにインサート
                if(insert_datalp($link,$new_name,$new_price,$new_status,$new_article,$new_img[0],$new_img[1],$new_img[2],$new_img[3],$new_img[4]) === true){
                    //insert_dataで生成されたidを取得
                    $id = mysqli_insert_id($link);
                    var_dump($id);
                    //product_stockにインサート
                    if(insert_stock($link,$id,$new_stock) === true){
                        $msg[] = 'インサート成功';
                        //トランザクション処理
                        mysqli_commit($link);
                    }else{
                        $error[] = 'インサート失敗';
                        //トランザクション/ロールバック処理
                        mysqli_rollback($link);
                    }
                }
            }
            //↑新規商品データの追加処理
        }
        if($sql_kind === 'update' ){
            //↓在庫データの更新処理↓
            $update_stock = get_post_data('update_stock');
            $item_id = get_post_data('item_id');
            if(check_update_stock($update_stock) === ''){
                if(update_stock($link,$update_stock,$item_id)){
                    $msg[] = '在庫を更新しました';
                }else{
                    $error[] = '更新に失敗しました';
                }
            }else{
                $error[] = check_update_stock($update_stock);
            }
            //↑在庫データの更新処理↑
        }
        if($sql_kind === 'change'){
            //↓ステータス更新処理↓
            $update_status = get_post_data('change_status');
            $item_id = get_post_data('item_id');
            if(update_status($link,$update_status,$item_id)){
                $msg[] = '公開ステータスを変更しました';
            }else{
                $error[] = '更新に失敗しました';
            }
            //↑ステータス更新処理↑
        }
        if($sql_kind === 'delete'){
            $item_id = get_post_data('item_id');
            delete_item($link,$item_id);
        }
    }
    //表示用配列の取得
    $view_data = get_product_data_list($link);
   // 接続を閉じます
   mysqli_close($link);
// 接続失敗した場合
} else {
   $error[] = 'DB接続失敗';
}
// 新規追加テンプレートファイル読み込み
include_once '../include/view/EC_item_tool.php';
?>