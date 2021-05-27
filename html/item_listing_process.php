<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

//ログインしていなければログイン画面へ移動
if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

//POSTで送信されたトークンがセッションにセットされている値を異なる場合はログインページへリダイレクト
if(is_valid_csrf_token($_POST['csrf_token']) === FALSE){
  redirect_to(LOGIN_URL);
}

//データーベースへ接続
$db = get_db_connect();
//ログインユーザー情報取得
$user = get_login_user($db);

//商品追加処理
$name = get_post('name');
$image = get_file('image');
$item_quality = get_post('item_quality');
$trade_item_name = get_post('trade_item_name');

//アイテムを出品
if(regist_item($db, $name, $image, $item_quality, $trade_item_name, $user["user_id"])){
  set_message('アイテムを登録しました。');
}else {
  set_error('アイテムの登録に失敗しました。');
}


redirect_to(LISTING_URL);
