<?php

define('MODEL_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../model/');
define('VIEW_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../view/');


define('IMAGE_PATH', '/assets/images/');
define('STYLESHEET_PATH', '/assets/css/');
define('IMAGE_DIR', $_SERVER['DOCUMENT_ROOT'] . '/assets/images/');

if($_SERVER['SERVER_ADDR']==='118.27.9.103'){
	define('DB_HOST', 'localhost');
}else {
	define('DB_HOST', 'mysql');
}
define('DB_NAME', 'toreco');
define('DB_USER', 'testuser');
define('DB_PASS', 'password');
define('DB_CHARSET', 'utf8');

define('SIGNUP_URL', '/signup.php');
define('LOGIN_URL', '/login.php');
define('LOGOUT_URL', '/logout.php');
define('HOME_URL', '/index.php');
define('LISTING_URL', '/item_listing.php');
define('LISTING_TABLE_URL', '/item_listing_table.php');
define('ITEM_SELECT_URL', '/item_select.php');
define('ADMIN_URL', '/admin.php');
define('TRADE_REQUEST_URL', '/trade_request.php');
define('TRADE_SUCCESS_HISTORY_URL', '/trade_success_history.php');

define('REGEXP_ALPHANUMERIC', '/\A[0-9a-zA-Z]+\z/');
define('REGEXP_POSITIVE_INTEGER', '/\A([1-9][0-9]*|0)\z/');


define('USER_NAME_LENGTH_MIN', 6);
define('USER_NAME_LENGTH_MAX', 100);
define('USER_PASSWORD_LENGTH_MIN', 6);
define('USER_PASSWORD_LENGTH_MAX', 100);

define('USER_TYPE_ADMIN', 1);
define('USER_TYPE_NORMAL', 2);

define('ITEM_NAME_LENGTH_MIN', 1);
define('ITEM_NAME_LENGTH_MAX', 100);

define('ITEM_STATUS_OPEN', 1);
define('ITEM_STATUS_CLOSE', 0);

define('PERMITTED_ITEM_QUALITY', array(
  'newitem' => 0,
  'nobaditem' => 1,
  'baditem' => 2,
));

define('PERMITTED_IMAGE_TYPES', array(
  IMAGETYPE_JPEG => 'jpg',
  IMAGETYPE_PNG => 'png',
));
