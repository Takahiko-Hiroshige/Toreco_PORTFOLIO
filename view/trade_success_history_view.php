<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>トレード履歴</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'cart.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>トレード履歴</h1>
  <div class="container">
    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <?php if(count($trade_success_historise) > 0){ ?>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>出品ユーザー</th>
            <th>出品アイテム</th>
            <th>トレードリクエストユーザー</th>
            <th>トレードリクエストアイテム</th>
            <th>トレード成立日</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($trade_success_historise as $trade_success_history){ ?>
          <tr>
            <td><?php print h($trade_success_history['user_name']); ?></td>
            <td><?php print h($trade_success_history['item_name']); ?></td>
            <td><?php print h($trade_success_history['request_user_name']); ?></td>
            <td><?php print h($trade_success_history['request_item_name']); ?></td>
            <td><?php print h($trade_success_history['created']); ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else { ?>
      <p>トレードされたアイテムはありません。</p>
    <?php } ?> 
  </div>
</body>
</html>