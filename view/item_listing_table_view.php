<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>出品アイテム一覧</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'cart.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>出品アイテム一覧</h1>
  <div class="container">
    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <?php if(count($listing_items) > 0){ ?>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>出品アイテム</th>
            <th>出品日時</th>
            <th>削除</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($listing_items as $listing_item){ ?>
          <tr>
            <td><?php print h($listing_item['name']); ?></td>
            <td><?php print h($listing_item['created']); ?></td>
            <td>
              <form method="post" action="item_listing_table_process.php">
                <input type="submit" value="削除" class="btn btn btn-danger delete">
                <input type="hidden" name="item_id" value="<?php print h($listing_item['item_id']); ?>">
                <input type="hidden" name="csrf_token" value="<?=$token?>">
              </form>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else { ?>
      <p>商品されたアイテムはありません。出品しましょう！</p>
    <?php } ?> 
  </div>
  <script>
    $('.delete').on('click', () => confirm('本当に削除しますか？'))
  </script>
</body>
</html>