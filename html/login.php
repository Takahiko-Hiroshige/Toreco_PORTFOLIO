<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';

session_start();

//ログイン済みであればホーム画面へ移動
if(is_logined() === true){
  redirect_to(HOME_URL);
}
//トークン生成
$token = get_csrf_token();

include_once VIEW_PATH . 'login_view.php';