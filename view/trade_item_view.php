<!DOCTYPE html>
<html lang="ja">
    <head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    
    <title>トレードリクエスト送信</title>
    <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'item_detail.css'); ?>">
    </head>
    <body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <h2>トレードリクエスト送信確認</h2>
    <div class="card mb-3" style="max-width: 1500px;">
    <div class="row g-0">
        <div class="col-md-4">
        <img class="card-img" src="<?php print(IMAGE_PATH . $item['image']); ?>">
        </div>
        <div class="col-md-8">
        <div class="card-body">
            <p class="title">アイテム名：</p>
            <p class="contents"><?php print h($item['item_name']); ?></p>
            <p class="title">出品者：</p>
            <p class="contents"><?php print h($item['name']); ?></p>
            <P class="title">アイテムの状態:</p>
                <?php if($item['item_quality'] === PERMITTED_ITEM_QUALITY['newitem']){ ?>
                    <p class="contents">未開封</p>
                <?php }else if($item['item_quality'] === PERMITTED_ITEM_QUALITY['nobaditem']){ ?>
                    <p class="contents">ほぼ新品</p>
                <?php }else if($item['item_quality'] === PERMITTED_ITEM_QUALITY['baditem']){ ?>
                    <p class="contents">傷あり</p>
                <?php } ?>
            <p class="title">トレードしたいアイテム：</p>
            <p class="contents"><?php print h($item['trade_item']); ?></p>
        </div>
        </div>
    </div>
    </div>
    <h2>トレードリクエストアイテム（マイアイテム）</h2>
    <div class="card mb-3" style="max-width: 1500px;">
    <div class="row g-0">
        <div class="col-md-4">
        <img class="card-img" src="<?php print(IMAGE_PATH . $trade_request_item['image']); ?>">
        </div>
        <div class="col-md-8">
        <div class="card-body">
            <p class="title">アイテム名：</p>
            <p class="contents"><?php print h($trade_request_item['item_name']); ?></h2>
            <p class="title">出品者：</p>
            <p class="contents"><?php print h($trade_request_item['name']); ?></p>
            <P class="title">アイテムの状態:</p>
                <?php if($trade_request_item['item_quality'] === PERMITTED_ITEM_QUALITY['newitem']){ ?>
                    <p class="contents">未開封</p>
                <?php }else if($trade_request_item['item_quality'] === PERMITTED_ITEM_QUALITY['nobaditem']){ ?>
                    <p class="contents">ほぼ新品</p>
                <?php }else if($trade_request_item['item_quality'] === PERMITTED_ITEM_QUALITY['baditem']){ ?>
                    <p class="contents">傷あり</p>
                <?php } ?>
            <p class="title">トレードしたいアイテム：</p>
            <p class="contents"><?php print h($trade_request_item['trade_item']); ?></p>
        </div>
        </div>
    </div>
    </div>
    </body>
</html>