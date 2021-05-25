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

//POSTで送信されたトークンがセッションにセットされている値を異なる場合はログインページへリダイレクト
if(is_valid_csrf_token($_GET['csrf_token']) === FALSE){
  redirect_to(LOGIN_URL);
}
//データーベースへ接続
$db = get_db_connect();
//ログインユーザー情報取得
$user = get_login_user($db);

//商品追加処理
$item_id = get_get('item_id');
$request_item_id = get_get('item_id');
$detail = get_get('detail');
$item = get_item($db, $item_id);

$trade_success_check = trade_success_check($db, $item_id, $request_item_id);

include_once VIEW_PATH . 'item_detail_view.php';