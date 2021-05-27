<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>トレードアイテム選択</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'cart.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>トレードアイテム選択</h1>
  <div class="container">
    <?php include VIEW_PATH . 'templates/messages.php'; ?>
        <?php if(count($trade_items) > 0){ ?>
        <h6>トレードするアイテムを選択してください。</h6>
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>出品アイテム名</th>
                    <th>トレード</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($trade_items as $trade_item){ ?>
                    <tr>
                        <td><?php print h($trade_item['name']); ?></td>
                        <td>
                            <form action="item_select_process.php" method="get">
                                <input type="submit" value="トレードする" class="btn btn-primary btn-block">
                                <input type="hidden" name="trade_item_id" value="<?php print h($trade_item['item_id']); ?>">
                                <input type="hidden" name="item_id" value="<?php print h($item_id); ?>">
                                <input type="hidden" name="user_id" value="<?php print h($user_id);?>">
                                <input type="hidden" name="csrf_token" value="<?=$token?>">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } else {?>
            <p>アイテムが出品されていません。</p>
        <?php } ?>
  </div>
</body>
</html>