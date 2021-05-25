<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'trade_request.php';

session_start();

//ログインしていなければログイン画面へ移動
if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

//データーベースへ接続
$db = get_db_connect();
//ログインユーザー情報取得
$user = get_login_user($db);
$user_id = $user["user_id"];
$request_user_id = $user["user_id"];

$trade_success_historise = get_trade_success_history($db, $user_id, $request_user_id);

include_once VIEW_PATH . 'trade_success_history_view.php';
