<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

// DB利用

function get_item($db, $item_id){
  $sql = "
    SELECT
      items.item_id,
      items.user_id,
      image,
      item_quality,
      trade_item,
      items.created,
      items.name AS item_name,
      users.name
    FROM
      items
    JOIN
      users
    ON
      items.user_id = users.user_id
    WHERE
      item_id = ?
  ";

  return fetch_query($db, $sql, array($item_id));
}

function get_items($db){
  $sql = '
    SELECT
      item_id, 
      user_id,
      name,
      image,
      item_quality,
      trade_item,
      items.created
    FROM
      items
    ';

  return fetch_all_query($db, $sql);
}

function get_listing_items($db, $user_id){
  $sql = '
    SELECT
      item_id, 
      user_id,
      name,
      image,
      item_quality,
      trade_item,
      created
    FROM
      items
    WHERE
      user_id = ?
    ORDER BY
      created DESC
    ';

  return fetch_all_query($db, $sql, array($user_id));
}

function get_trade_items_check($db, $item_id, $trade_item_id){
  $sql = '
    SELECT
      request_id, 
      user_id,
      request_user_id,
      item_id,
      request_item_id
    FROM
      trade_requests
    WHERE
      item_id = ? AND request_item_id = ?
    ';

  return fetch_query($db, $sql, array($item_id, $trade_item_id));
}
function get_trade_items($db, $user_id){
  $sql = '
    SELECT
      item_id, 
      user_id,
      name,
      image,
      item_quality,
      trade_item,
      created
    FROM
      items
    WHERE
      user_id = ?
    ';

  return fetch_all_query($db, $sql, array($user_id));
}

function delete_item($db, $item_id){
  $sql = "
    DELETE FROM
      items
    WHERE
      item_id = ?
    LIMIT 1
  ";
  
  return execute_query($db, $sql, array($item_id));
}

function item_trade_request($db, $user_id, $request_user_id, $item_id, $request_item_id){
  $sql = "
    INSERT INTO
      trade_requests(
        user_id,
        request_user_id,
        item_id,
        request_item_id
      )
    VALUES(?, ?, ?, ?);
  ";
  return execute_query($db, $sql, array($user_id, $request_user_id, $item_id, $request_item_id));
}

function get_all_items($db){
  return get_items($db);
}

function get_open_items($db){
  return get_items($db, true);
}

function regist_item($db, $name, $image, $item_quality, $trade_item_name, $user_id){
  $filename = get_upload_filename($image);
  if(validate_item($name, $filename, $item_quality, $trade_item_name) === false){
    return false;
  }
  return regist_item_transaction($db, $user_id, $name, $image, $item_quality, $trade_item_name, $filename);
}

function regist_item_transaction($db, $user_id, $name, $image, $item_quality, $trade_item_name, $filename){
  $db->beginTransaction();
  if(insert_item($db, $user_id, $name, $item_quality, $trade_item_name, $filename) 
    && save_image($image, $filename)){
    $db->commit();
    return true;
  }
  $db->rollback();
  return false;
}

function insert_item($db, $user_id, $name, $item_quality, $trade_item_name, $filename){
  $item_quality_value = PERMITTED_ITEM_QUALITY[$item_quality];
  $sql = "
    INSERT INTO
      items(
        user_id,
        name,
        image,
        item_quality,
        trade_item,
        created
      )
    VALUES(?, ?, ?, ?, ?, NOW());
  ";
  return execute_query($db, $sql, array($user_id, $name, $filename, $item_quality_value, $trade_item_name));
}

function destroy_item($db, $item_id){
  $item = get_item($db, $item_id);
  if($item === false){
    return false;
  }
  $db->beginTransaction();
  if(delete_item($db, $item['item_id'])
    && delete_image($item['image'])){
    $db->commit();
    return true;
  }
  $db->rollback();
  return false;
}

// 非DB

function validate_item($name, $filename, $item_quality, $trade_item_name){
  $is_valid_item_name = is_valid_item_name($name);
  $is_valid_item_filename = is_valid_item_filename($filename);
  $is_valid_item_quality = is_valid_item_quality($item_quality);
  $is_valid_item_trade_item_name = is_valid_item_trade_item_name($trade_item_name);

  return $is_valid_item_name
    && $is_valid_item_filename
    && $is_valid_item_quality
    && $is_valid_item_trade_item_name;
}

function is_valid_item_name($name){
  $is_valid = true;
  if(is_valid_length($name, ITEM_NAME_LENGTH_MIN, ITEM_NAME_LENGTH_MAX) === false){
    set_error('アイテム名は'. ITEM_NAME_LENGTH_MIN . '文字以上、' . ITEM_NAME_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  return $is_valid;
}

function is_valid_item_trade_item_name($trade_item_name){
  $is_valid = true;
  if(is_valid_length($trade_item_name, ITEM_NAME_LENGTH_MIN, ITEM_NAME_LENGTH_MAX) === false){
    set_error('トレードしたいアイテム名は'. ITEM_NAME_LENGTH_MIN . '文字以上、' . ITEM_NAME_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  return $is_valid;
}

function is_valid_item_filename($filename){
  $is_valid = true;
  if($filename === ''){
    $is_valid = false;
  }
  return $is_valid;
}

function is_valid_item_quality($item_quality){
  $is_valid = true;
  if(isset(PERMITTED_ITEM_QUALITY[$item_quality]) === false){
    $is_valid = false;
  }
  return $is_valid;
}