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
if(is_valid_csrf_token($_GET['csrf_token']) === FALSE){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();

//ログインユーザー情報取得
$user = get_login_user($db);

$user_id = $_GET["user_id"];
$request_user_id = $user["user_id"];
$item_id = $_GET["item_id"];
$trade_item_id = $_GET["trade_item_id"];
if(get_trade_items_check($db, $item_id, $trade_item_id) !== FALSE){
    set_error('すでにリクエスト送信済みです。');
    $item = get_item($db, $item_id);
    $trade_request_item = get_item($db, $trade_item_id);
} else if(item_trade_request($db, $user_id, $request_user_id, $item_id, $trade_item_id)){
    set_message('トレードリクエスト送信しました。');
    $item = get_item($db, $item_id);
    $trade_request_item = get_item($db, $trade_item_id);
} else {
    set_error('トレードリクエスト送信に失敗しました。');
    redirect_to(ITEM_SELECT_URL);
}
include_once VIEW_PATH . 'trade_item_view.php';