<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>アイテム一覧</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'index.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  

  <div class="container">
    <h1>商品一覧</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <div class="card-deck" style="max-width: 700px;">
      <div class="row">
      <?php foreach($items as $item){ ?>
        <div class="col-6 item">
          <div class="card h-100 text-center mb-0">
            <div class="card-header">
              <?php print h($item['name']); ?>
            </div>
            <figure class="card-body mb-0">
              <img class="card-img-top" style="height: 130px" src="<?php print(IMAGE_PATH . $item['image']); ?>">
              <figcaption class="mt-4">
                  <form action="item_detail.php" method="get">
                    <input type="submit" value="アイテム詳細" class="btn btn-primary btn-block">
                    <input type="hidden" name="item_id" value="<?php print h($item['item_id']); ?>">
                    <input type="hidden" name="csrf_token" value="<?=$token?>">
                  </form>
              </figcaption>
            </figure>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
  </div>
</body>
</html>
