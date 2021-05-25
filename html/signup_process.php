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

//ユーザー登録処理
$name = get_post('name');
$password = get_post('password');
$password_confirmation = get_post('password_confirmation');
$db = get_db_connect();

try{
  $result = regist_user($db, $name, $password, $password_confirmation);
  if($result=== false){
    set_error('ユーザー登録に失敗しました。');
    redirect_to(SIGNUP_URL);
  }
}catch(PDOException $e){
  set_error('ユーザー登録に失敗しました。');
  redirect_to(SIGNUP_URL);
}

set_message('ユーザー登録が完了しました。');
login_as($db, $name, $password);
redirect_to(HOME_URL);