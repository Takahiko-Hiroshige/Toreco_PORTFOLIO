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

//データーベースへ接続
$db = get_db_connect();
//ログインユーザー情報取得
$user = get_login_user($db);
//トークン生成
$token = get_csrf_token();

//ユーザーの出品アイテム情報を取得
if(is_admin($user)){
  $listing_items = get_all_listing_items($db);
}else {
  $listing_items = get_listing_items($db, $user["user_id"]);
}

include_once VIEW_PATH . 'item_listing_table_view.php';