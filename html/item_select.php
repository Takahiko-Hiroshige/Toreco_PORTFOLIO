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

$item_id = $_GET["item_id"];
$user_id = $_GET["user_id"];

//出品アイテムからトレードしたいアイテム情報を取得
$trade_items = get_trade_items($db, $user["user_id"]);

include_once VIEW_PATH . 'item_select_view.php';