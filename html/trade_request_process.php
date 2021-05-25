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
if(is_valid_csrf_token($_POST['csrf_token']) === FALSE){
  redirect_to(LOGIN_URL);
}

//データーベースへ接続
$db = get_db_connect();
//ログインユーザー情報取得
$user = get_login_user($db);
$user_name = $user["name"];
$request_id = $_POST["request_id"];
$request_user = get_trade_request_user_name($db, $request_id);
$request_user_name = $request_user["name"];
$user_id = $_POST["user_id"];
$request_user_id = $_POST["request_user_id"];
$item_id = $_POST["item_id"];
$item_name = $_POST["item_name"];
$request_item_id = $_POST["request_item_id"];
$trade_request_item_name = $_POST["trade_request_item_name"];

if(get_get("detail") === "detail"){
  redirect_to(TRADE_REQUEST_URL);
}

if(get_post("request_result") === "Approval"){
  if(approval_process($db, $request_id, $user_id, $user_name, $request_user_id, $request_user_name,
  $item_id, $item_name, $request_item_id, $trade_request_item_name) === TRUE){
    set_message('トレードリクエストを承認しました。');
  } else {
  set_error('トレードリクエストの承認に失敗しました。');
  }
}

if(get_post("request_result") === "delete"){
  if(reject_trade_request($db, $request_id) === TRUE){
    set_message('トレードリクエストを拒否しました。');
  } else {
  set_error('トレードリクエストの拒否に失敗しました。');
  }
}

redirect_to(TRADE_REQUEST_URL);
