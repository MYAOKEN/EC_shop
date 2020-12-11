<?php

/**
* 特殊文字をHTMLエンティティに変換する
* @param str  $str 変換前文字
* @return str 変換後文字
*/
function entity_str($str) {
    return htmlspecialchars($str, ENT_QUOTES, HTML_CHARACTER_SET);
}

/**
* 特殊文字をHTMLエンティティに変換する(2次元配列の値)
* @param array  $assoc_array 変換前配列
* @return array 変換後配列
*/
function entity_assoc_array($assoc_array) {

    foreach ($assoc_array as $key => $value) {

        foreach ($value as $keys => $values) {
            // 特殊文字をHTMLエンティティに変換
            $assoc_array[$key][$keys] = entity_str($values);
        }

    }

    return $assoc_array;

}

/**
* DBハンドルを取得
* @return obj $link DBハンドル
*/
function get_db_connect() {
    $link = '';
    // コネクション取得
    if (!$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME)) {
        die('error: ' . mysqli_connect_error());
    }

    // 文字コードセット
    mysqli_set_charset($link, DB_CHARACTER_SET);

    return $link;
}

/**
* DBとのコネクション切断
* @param obj $link DBハンドル
*/
function close_db_connect($link) {
    // 接続を閉じる
    mysqli_close($link);
}

/**
* クエリを実行しその結果を配列で取得する
*
* @param obj  $link DBハンドル
* @param str  $sql SQL文
* @return array 結果配列データ
*/
function get_as_array($link, $sql) {
    // 返却用配列
    $data = array();
    // クエリを実行する
    if ($result = mysqli_query($link, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            // １件ずつ取り出す
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        // 結果セットを開放
        mysqli_free_result($result);
    }
    return $data;
}

//カート表示情報の配列を取得
function get_as_array_cart($link, $sql) {
    // 返却用配列
    $data = array();
    // クエリを実行する
    if ($result = mysqli_query($link, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            // １件ずつ取り出す
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        // 結果セットを開放
        mysqli_free_result($result);
    }
    return $data;
}

/**
* 商品の一覧を取得する
*
* @param obj $link DBハンドル
* @return array 商品一覧配列データ
*/
function get_product_data_list($link) {

    // SQL生成
    $sql = "SELECT * FROM item JOIN stock ON item.item_id = stock.item_id";

    // クエリ実行
    return get_as_array($link, $sql);

}
//「表示」ステータスの商品一覧配列データ
function get_product_data_list_display($link) {

    // SQL生成
    $sql = "SELECT * FROM item
            JOIN stock ON item.item_id = stock.item_id
            WHERE item.status = 1";

    // クエリ実行
    return get_as_array($link, $sql);

}

//TOP画面で選択した商品の配列データ取得
function get_select_product($link,$item_id){
    // SQL生成
    $sql = "SELECT item.item_id,item.img,item.img2,item.img3,item.img4,item.img5,item.name,item.price,item.article,stock.stock
    FROM item,stock
    WHERE item.item_id = $item_id
    AND stock.item_id = $item_id";
    // くクエリ実行
    return get_as_array($link, $sql);
}

//ユーザー情報の取得
function get_user_list($link){
    // SQL生成
    $sql = "SELECT * FROM user";
    // クエリ実行
    return get_as_array($link, $sql);
}

function get_buying_his_list($link){
    // SQL生成
    $sql = "SELECT * FROM buying_history";
    // クエリ実行
    return get_as_array($link, $sql);
}

//カート情報の取得
function get_cart_list($link,$user_name){
    // SQL生成
    $sql = "SELECT item.item_id,item.img,item.name,item.price,user.user_name,cart.amount
    FROM item,user,cart
    WHERE cart.user_id = user.id
    AND user.user_name='$user_name'
    AND cart.item_id = item.item_id";
    // くクエリ実行
    return get_as_array_cart($link, $sql);
}

//カートprice配列のみ取得
function get_cart_price($link,$user_name){
    $sum = 0;
    // SQL生成
    $sql = "SELECT item.price*cart.amount
    FROM item,user,cart
    WHERE cart.user_id = user.id
    AND user.user_name='$user_name'
    AND cart.item_id = item.item_id";
    // くクエリ実行
    $sum_array = get_as_array_cart($link, $sql);
    foreach($sum_array as $array) {
    foreach($array as $value) {
        $sum += $value;
    }
}
return $sum;
}

/**
* insertを実行する
*
* @param obj $link DBハンドル
* @param str SQL文
* @return bool
*/
function insert_db($link, $sql) {
   // クエリを実行する
   if (mysqli_query($link, $sql) === TRUE) {
       return TRUE;
   } else {
       return FALSE;
   }
}
/**
* 新規商品を追加する
*
* @param obj $link DBハンドル
* @param str $goods_name 商品名
* @param int $price 価格
* @return bool
*/
//product_dataテーブルへデータを挿入
//MySQL5.6からはそのようなdefault値がないカラムの情報を追加する場合に、カラムの情報を書かない場合は自動で補完されるのではなく、エラーになる。update_dateにデフォルトでNULLが入るようにしました。
function insert_data($link,$name,$price,$status,$article,$img){
    $sql = "INSERT INTO item(name, price, status, img, created_date, article) VALUES ('$name','$price','$status','$img',now(),'$article')";
    //sql実行/返値true or false
    return insert_db($link,$sql);
}

function insert_datalp($link,$name,$price,$status,$article,$img,$img2,$img3,$img4,$img5){
    $sql = "INSERT INTO item(name, price, status, img,img2,img3,img4,img5, created_date, article) VALUES ('$name','$price','$status','$img','$img2','$img3','$img4','$img5',now(),'$article')";
    //sql実行/返値true or false
    return insert_db($link,$sql);
}

//product_stockデータテーブルへデータを挿入
function insert_stock($link,$id,$stock){
    $sql = "INSERT INTO stock(item_id,stock,created_date) VALUES($id,'$stock', now())";
    //sql実行/返値true or false
    return mysqli_query($link,$sql);
}
//product_stockの在庫データを更新
function update_stock($link,$stock,$id){
    $sql = "UPDATE stock SET stock = '$stock' , updated_date = now() WHERE item_id = '$id'";
    //sql実行/返値true or false
    return mysqli_query($link,$sql);
}

//product_dataのステータス更新
function update_status($link,$status,$id){
    if($status === '0'){
            $query = "UPDATE item SET status = '1' , updated_date = now()  WHERE item_id = '$id'";
        }else if($status === '1'){
            $query = "UPDATE item SET status = '0' , updated_date = now()  WHERE item_id = '$id'";
        }
    return mysqli_query($link,$query);
}



//商品削除
function delete_item($link,$item_id){
    global $msg;
    $query = "DELETE item, stock FROM item INNER JOIN stock ON item.item_id = stock.item_id WHERE item.item_id = $item_id";
    mysqli_query($link,$query);
    return $msg[] = 'アイテムを削除しました';
}

//カート商品削除
function delete_cart_item($link,$item_id,$user_name){
    $query = "DELETE cart FROM cart INNER JOIN user ON cart.user_id = user.id WHERE cart.item_id = $item_id AND user.user_name = '$user_name'" ;
    return mysqli_query($link,$query);
}

//ユーザー情報新規登録
function insert_user($link,$user_name,$passwd){
    $query = "INSERT INTO user (user_name,password,created_date) VALUES ('$user_name','$passwd',now())";
    //sql実行/返値true or false
    return mysqli_query($link,$query);
}

//商品をカートに入れる
function insert_cart($link,$item_id,$user_name,$amount,$stock){
    global $msg;
    //userテーブルから$user_nameに該当するuser_idを抽出
    $query = "SELECT id FROM user WHERE user_name = '$user_name'";
    $result = mysqli_query($link,$query);
    $row = mysqli_fetch_array($result);
    $user_id = $row['id'];
    //cartテーブルから$item_id,$user_idに該当するレコードを抽出
    $sql = "SELECT * FROM cart WHERE item_id = '$item_id' AND user_id = '$user_id'";
    $result = mysqli_query($link,$sql);
    $row_s = mysqli_fetch_array($result);
    //if(preg_match('/^[1-9]{1,10}$/', $amount) === 1){
    //カートに同じuser,item情報があるか確認
    if(is_array($row_s) === false){
        //cartへ情報をinsert
        $query = "INSERT INTO cart (user_id,item_id,amount,created_date) VALUES ('$user_id','$item_id','$amount',now())";
        //sql実行/返値true or false
        return mysqli_query($link,$query);
    }else{
        //cartテーブルからamount抽出
        $sql = "SELECT * FROM cart WHERE item_id = '$item_id' AND user_id = '$user_id'";
        $result = mysqli_query($link,$sql);
        $row_a = mysqli_fetch_array($result);
        //return var_dump($row_a);
        $amount_cart = $row_a['amount'];
        if($stock >= ($amount_cart + $amount)){
            //userカートの注文数を更新
            $query = "UPDATE cart SET amount = amount+'$amount',updated_date = now()  WHERE user_id = '$user_id' AND item_id = '$item_id'";
            //sql実行/返値true or false
            return mysqli_query($link,$query);
        }else{
            $msg[] = '在庫切れです';
            return $msg;
        }
    }
    // }else{
    //     $error[] = '注文数は数値で入力してください';
    //     return $error;
    // }
}

//カート情報の更新
function update_cart($link,$item_id,$user_name,$select_amount){
    global $msg;
    $sql = "SELECT cart.amount,cart.user_id FROM cart,user WHERE cart.user_id = user.id AND user.user_name = '$user_name' AND cart.item_id = '$item_id'";
    $result = mysqli_query($link,$sql);
    $row_a = mysqli_fetch_array($result);
    $now_amount = $row_a['amount'];
    $user_id = $row_a['user_id'];
    $sql = "SELECT stock FROM stock WHERE item_id = '$item_id'";
    $result = mysqli_query($link,$sql);
    $row_i = mysqli_fetch_array($result);
    $stock = $row_i['stock'];
    if($stock >= $now_amount && $stock >= $select_amount){
        // if(preg_match('/^[1-9]+$/',$select_amount) === 1){
        //userカートの注文数を更新
        $query = "UPDATE cart SET amount = '$select_amount',updated_date = now()  WHERE user_id = '$user_id' AND item_id = '$item_id'";
        //sql実行/返値true or false
        mysqli_query($link,$query);
        return print '更新しました';
        // }else{
        //     $msg[] = '注文数は1以上の数値で入力してください';
        // }
    }else{
        $msg[] = '在庫切れです';
    }
}

//購入履歴
function buy($link,$user_name){
    $query = "INSERT INTO buying_history(user_id,item_id,amount,buying_day)
             SELECT cart.user_id,cart.item_id,cart.amount,now()
             FROM cart,user
             WHERE cart.user_id = user.id
             AND user.user_name = '$user_name'";
    return mysqli_query($link,$query);
}

//在庫数変更
function controll_stock($link,$user_name){
    global $error;
    $row = array();
    $sql = "SELECT cart.amount,stock.stock,stock.item_id
            FROM cart
            LEFT JOIN user ON user.id = cart.user_id
            LEFT JOIN stock ON cart.item_id = stock.item_id
            LEFT JOIN item ON cart.item_id = item.item_id
            WHERE user.user_name = '$user_name'";
   // $result = mysqli_query($link,$sql);
   // クエリ実行
    $row = get_as_array($link, $sql);
    foreach($row as $vals){
    $amount[] = $vals['amount'];
    $stock[] = $vals['stock'];
    $id[] = $vals['item_id'];
    }
    for($i=0;$i<count($id);$i++){
        $sub = $stock[$i]-$amount[$i];
        $id_i = $id[$i];
        $sql_sub = "UPDATE stock SET stock = '$sub' , updated_date = now() WHERE item_id = '$id_i'";
        if(mysqli_query($link,$sql_sub) !== true){
            $error[] = 'stock_update_error';
        }
    }
return $error;
}

//userのカート情報削除
function delete_cart($link,$user_name){
    global $error;
    $query = "DELETE cart FROM cart INNER JOIN user ON cart.user_id = user.id WHERE user.user_name = '$user_name'" ;
    if(mysqli_query($link,$query) !== true){
        $error[] = 'delete error';
    }
    return $error;
}

/**
* リクエストメソッドを取得
* @return str GET/POST/PUTなど
*/
function get_request_method() {
   return $_SERVER['REQUEST_METHOD'];
}
/**
* POSTデータを取得
* @param str $key 配列キー
* @return str POST値
*/
function get_post_data($key) {
   $str = '';
   if (isset($_POST[$key]) === TRUE) {
       $str = $_POST[$key];
   }
   return $str;
}

//画像データ取得&画像名を作成
function check_file_data($key){
    global $error;
    if(isset($_FILES[$key]) === false){
        $error[] = '画像ファイルを指定してください';
    }else if($_FILES[$key]['error'] !== 0){
        $error[] = '画像ファイルを指定してください';
    }else if($_FILES[$key]['type'] !== "image/jpeg" && $_FILES[$key]['type'] !== "image/png"){
        $error[] = '画像はjpg/pngのみ選択できます';
    }
    return $error;
}

//画像データ取得&画像名を作成
function check_file_datalp($key,$i){
    global $error;
    if(isset($_FILES[$key]) === false){
        $error[] = '画像ファイルを指定してください';
    }else if($_FILES[$key]['error'] !== 0){
        $error[] = '画像ファイルを指定してください';
    }else if($_FILES[$key]['type'][$i] !== "image/jpeg" && $_FILES[$key]['type'][$i] !== "image/png"){
        $error[] = '画像はjpg/pngのみ選択できます';
    }
    return $error;
}

function get_file_data($key){
    $new_img = '';
    if($_FILES[$key]['type'] === "image/jpeg" || $_FILES[$key]['type'] === "image/png"){
        //ランダムで画像名を作成
        $new_img = md5(uniqid(mt_rand(), true));
        if($_FILES[$key]['type'] === "image/jpeg"){
            $new_img = $new_img . '.jpeg';
        }else{
            $new_img = $new_img . '.png';
        }
    return $new_img;
    }
}

function get_file_datalp($key,$i){
    $new_img = '';
    if($_FILES[$key]['type'][$i] === "image/jpeg" || $_FILES[$key]['type'][$i] === "image/png"){
        //ランダムで画像名を作成
        $new_img = md5(uniqid(mt_rand(), true));
        if($_FILES[$key]['type'][$i] === "image/jpeg"){
            $new_img = $new_img . '.jpeg';
        }else{
            $new_img = $new_img . '.png';
        }
        return $new_img;
    }
}

//画像アップロード
function upload_img($key,$img_name){
    move_uploaded_file($_FILES[$key]['tmp_name'], './item_img/' . $img_name);
}

//画像アップロード
function upload_imglp($key,$i,$img_name){
    move_uploaded_file($_FILES[$key]['tmp_name'][$i], './item_img/' . $img_name);
}


//商品名入力チェック
function check_name($name){
    global $error;
    if($name === ''){
        $error[] = '商品名を入力してください';
    }else if(preg_match('/^( |　)+$/', $name) === 1){
        $error[] = '不正な入力です';
    }
    return $error;
}
//商品金額の入力チェック
function check_price($price){
    global $error;
    if($price < '1'){
        $error[] = '金額は1以上で入力してください';
    }else if(preg_match('/^[0-9]+$/',$price) !== 1){
        $error[] = '金額が不正です';
    }
    return $error;
}
//在庫数の入力チェック
function check_stock($stock){
    global $error;
    if($stock === ''){
        $error[] = '在庫数を入力してください';
    }else if($stock < '1'){
        $error[] = '在庫数は1以上に設定してください';
    }else if(preg_match('/^([1-9][0-9]*)+$/',$stock) !== 1){
        $error[] = '在庫数が不正です';
    }
    return $error;
}

//在庫更新の入力チェック
function check_update_stock($stock){
    $msg = '';
    if($stock < '1'){
        $msg = '在庫数は1以上に設定してください';
    }else if(preg_match('/^([1-9][0-9]*)+$/',$stock) !== 1) {
        $msg = '不正な入力です';
    }
    return $msg;
}

//注文数の入力チェック
function check_amount($amount){
    global $msg;
    if($amount < '1'){
        $msg[] = '注文数は1以上に設定してください';
    }else if(preg_match('/^([1-9][0-9]*)+$/',$amount) !== 1) {
        $msg[] = '不正な入力です(注文数は0以上の数字で入力してください)';
    }
    return $msg;
}

//登録：ユーザー名の確認
function check_user_name($link,$name){
    global $error;
    $cnt = 0;
    if(preg_match("/^[a-zA-Z0-9]{6,}+$/", $name) !== 1){
        $error[] = 'ユーザー名は半角英数字6文字以上で入力してください';
    }
    $sql = "SELECT * FROM user WHERE user_name = '$name'";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_array($result);
    if(count($row) !== 0 ){
        $error[] = '既に使用されているユーザー名です';
    }
}

//登録：パスワードの確認
function check_passwd($passwd){
    global $error;
    if(preg_match("/^[a-zA-Z0-9]{6,}+$/", $passwd) !== 1){
        $error[] = 'パスワードは半角英数字6文字以上で入力してください';
    }
}


//カートの商品有無
function check_cart($link,$user_name){
    global $error;
    //userテーブルから$user_nameに該当するuser_idを抽出
    $query = "SELECT id FROM user WHERE user_name = '$user_name'";
    $result = mysqli_query($link,$query);
    $row = mysqli_fetch_array($result);
    $user_id = $row['id'];
    //cartテーブルから$item_id,$user_idに該当するレコードを抽出
    $sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
    $result = mysqli_query($link,$sql);
    $row_s = mysqli_fetch_array($result);
    if(count($row_s) === 0 ){
        $error[] = 'カートに商品がはいっていません';
    }
    return $error;
}

//ユーザーチェック
function check_user_regist($link,$user_name,$passwd){
    global $error;
    $sql = "SELECT * FROM user WHERE user_name = '$user_name'";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_array($result);
    $sql_l = "SELECT * FROM user WHERE password = '$passwd'";
    $result_l = mysqli_query($link,$sql_l);
    $row_pass = mysqli_fetch_array($result_l);
    if(count($row) === 0 ){
        $error[] = 'ユーザー情報が登録されていません';
    }else if(count($row) !== 0 && count($row_pass) === 0){
        $error[] = 'パスワードが違います';
    }
}

//在庫確認
function check_item_stock($link,$user_name){
    global $error;
    $row = array();
    $sql = "SELECT cart.amount,stock.stock,item.name
            FROM cart
            LEFT JOIN user ON user.id = cart.user_id
            LEFT JOIN stock ON cart.item_id = stock.item_id
            LEFT JOIN item ON cart.item_id = item.item_id
            WHERE user.user_name = '$user_name'";
   // $result = mysqli_query($link,$sql);
   // クエリ実行
    $row = get_as_array($link, $sql);
    foreach($row as $vals){
    $amount[] = $vals['amount'];
    $stock[] = $vals['stock'];
    $name[] = $vals['name'];
    }
    for($i=0;$i<count($name);$i++){
        if($amount[$i]>$stock[$i]){
            $error[]=$name[$i].'の在庫が不足しています';
        }
    }
return $error;

    //$amount = $row['amount'];
    //$item_id = $row['item_id'];
    //return $row;
}

