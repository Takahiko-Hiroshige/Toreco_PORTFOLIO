<?php
function get_trade_requests($db, $user_id){
  $sql = '
    SELECT
      trade_requests.request_id,
      trade_requests.request_user_id,
      trade_requests.user_id,
      trade_requests.item_id,
      trade_requests.request_item_id,
      users.user_id,
      users.name,
      items1.name AS trade_item_name,
      items2.name AS item_name
    FROM
      trade_requests
    JOIN
      users
    ON
      users.user_id = trade_requests.user_id
    JOIN
      items AS items1
    ON
      trade_requests.request_item_id = items1.item_id
    JOIN
      items AS items2
    ON
      trade_requests.item_id = items2.item_id
    WHERE
      trade_requests.user_id = ?
    ';
  return fetch_all_query($db, $sql, array($user_id));
}

function get_trade_request_user_name($db, $request_id){
  $sql = '
    SELECT
      trade_requests.request_id,
      trade_requests.request_user_id,
      users.user_id,
      users.name
    FROM
      trade_requests
    JOIN
      users
    ON
      users.user_id = trade_requests.request_user_id
    WHERE
      trade_requests.request_id = ?
    ';
  return fetch_query($db, $sql, array($request_id));
}

function approval_process($db, $request_id, $user_id, $user_name, $request_user_id, 
$request_user_name, $item_id, $item_name, $request_item_id, $trade_request_item_name){
    $db->beginTransaction();
    if(insert_trade_success_history($db,$user_id, $user_name, $request_user_id, $request_user_name,
     $item_id, $item_name, $request_item_id, $trade_request_item_name)
      && reject_trade_request($db, $request_id)){
      $db->commit();
      return true;
    }
    $db->rollback();
    return false;
}

function insert_trade_success_history($db, $user_id, $user_name, $request_user_id, $request_user_name,
 $item_id, $item_name, $request_item_id, $trade_request_item_name){
    $sql = "
      INSERT INTO
        trade_success_history(
          user_id,
          user_name,
          request_user_id,
          request_user_name,
          item_id,
          item_name,
          request_item_id,
          request_item_name,
          created
        )
      VALUES(?, ?, ?, ?, ?, ?, ?, ?, NOW());
    ";
    return execute_query($db, $sql, 
    array($user_id, $user_name, $request_user_id, $request_user_name, $item_id, $item_name, $request_item_id, $trade_request_item_name));
}

function reject_trade_request($db, $request_id){
    $sql = "
      DELETE FROM
        trade_requests
      WHERE
        request_id = ?
      LIMIT 1
    ";
    
  return execute_query($db, $sql, array($request_id));
}

function delete_trade_request($db, $item_id, $request_item_id){
  $sql = "
    DELETE FROM
      trade_requests
    WHERE
      item_id = ?
    OR
      request_item_id = ?
  ";
  return execute_query($db, $sql, array($item_id, $request_item_id));
}

function trade_success_check($db, $item_id, $request_item_id){
  $sql = '
    SELECT
      item_id,
      request_item_id
    FROM
      trade_success_history
    WHERE
      item_id = ?
    OR
      request_item_id = ?
    ';
  return fetch_query($db, $sql, array($item_id, $request_item_id));
}

function get_trade_success_history($db, $user_id, $request_user_id){
  $sql = '
    SELECT
      user_name,
      item_name,
      request_user_name,
      request_item_name,
      created
    FROM
      trade_success_history
    WHERE
      user_id = ?
    OR
      request_user_id = ?
    ';
  return fetch_all_query($db, $sql, array($user_id, $request_user_id));
}