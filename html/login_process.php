<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';

session_start();

//ログイン済みであればホーム画面へ移動
if(is_logined() === true){
  redirect_to(HOME_URL);
}

//POSTで送信されたトークンがセッションにセットされている値を異なる場合はログインページへリダイレクト
if(is_valid_csrf_token($_POST['csrf_token']) === FALSE){
  redirect_to(LOGIN_URL);
}

$name = get_post('name');
$password = get_post('password');

//データーベースへ接続
$db = get_db_connect();
//ログイン処理
$user = login_as($db, $name, $password);
if( $user === false){
  set_error('ログインに失敗しました。');
  redirect_to(LOGIN_URL);
}

set_message('ログインしました。');
if ($user['type'] === USER_TYPE_ADMIN){
  redirect_to(ADMIN_URL);
}
redirect_to(HOME_URL);