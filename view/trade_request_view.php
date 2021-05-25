<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>トレードリクエスト</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'cart.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>トレードリクエスト</h1>
  <div class="container">
    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <?php if(count($trade_requests) > 0){ ?>
      <div class="text-center">
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>出品アイテム</th>
            <th>トレードリクエストアイテム</th>
            <th>詳細</th>
            <th>承認</th>
            <th>拒否</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($trade_requests as $trade_request){ ?>
          <tr>
            <td><?php print h($trade_request['item_name']);?></td>
            <td><?php print h($trade_request['trade_item_name']);?></td>
            <td>
              <form method="get" action="item_detail.php">
                <input type="submit" value="詳細" class="btn btn-secondary">
                <input type="hidden" name="item_id" value="<?php print h($trade_request['request_item_id']); ?>">
                <input type="hidden" name="detail" value="detail">
                <input type="hidden" name="csrf_token" value="<?=$token?>">
              </form>
            </td>
            <td>
              <div style="margin-bottom:10px">
              <form method="post" action="trade_request_process.php">
                <input type="submit" value="承認" class="btn btn-primary Approval">
                <input type="hidden" name="request_id" value="<?php print h($trade_request['request_id']); ?>">
                <input type="hidden" name="user_id" value="<?php print h($trade_request['user_id']); ?>">
                <input type="hidden" name="request_user_id" value="<?php print h($trade_request['request_user_id']); ?>">
                <input type="hidden" name="item_id" value="<?php print h($trade_request['item_id']); ?>">
                <input type="hidden" name="item_name" value="<?php print h($trade_request['item_name']); ?>">
                <input type="hidden" name="request_item_id" value="<?php print h($trade_request['request_item_id']); ?>">
                <input type="hidden" name="trade_request_item_name" value="<?php print h($trade_request['trade_item_name']); ?>">
                <input type="hidden" name="request_result" value="Approval">
                <input type="hidden" name="csrf_token" value="<?=$token?>">
              </form>
              </div>
            </td>
            <td>
              <form method="post" action="trade_request_process.php">
                <input type="submit" value="拒否" class="btn btn-danger delete">
                <input type="hidden" name="request_id" value="<?php print h($trade_request['request_id']); ?>">
                <input type="hidden" name="request_result" value="delete">
                <input type="hidden" name="csrf_token" value="<?=$token?>">
              </form>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      </div>
      </div>
    <?php } else { ?>
      <p>トレードリクエストが送信されていません。</p>
    <?php } ?>
  <script>
    $('.Approval').on('click', () => confirm('本当に承認しますか？'))
    $('.delete').on('click', () => confirm('本当に拒否しますか？'))
  </script>
</body>
</html>