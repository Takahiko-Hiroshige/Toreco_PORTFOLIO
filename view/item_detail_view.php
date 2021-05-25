<!DOCTYPE html>
<html lang="ja">
    <head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    
    <title>アイテム詳細</title>
    <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'item_detail.css'); ?>">
    </head>
    <body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <h1>アイテム詳細</h1>
    <div class="card mb-3" style="max-width: 1500px;">
    <div class="row g-0">
        <div class="col-md-4">
        <img class="card-img" src="<?php print(IMAGE_PATH . $item['image']); ?>">
        </div>
        <div class="col-md-8">
        <div class="card-body">
            <p class="title">アイテム名：</p>
            <p class="contents"><?php print h($item['item_name']); ?></h2>
            <p class="title">出品者：</p>
            <p class="contents"><?php print h($item["name"]); ?>
            <P class="title">アイテムの状態：</p>
                <?php if($item['item_quality'] === PERMITTED_ITEM_QUALITY['newitem']){ ?>
                    <p class="contents">未開封</p>
                <?php }else if($item['item_quality'] === PERMITTED_ITEM_QUALITY['nobaditem']){ ?>
                    <p class="contents">ほぼ新品</p>
                <?php }else if($item['item_quality'] === PERMITTED_ITEM_QUALITY['baditem']){ ?>
                    <p class="contents">傷あり</p>
                <?php } ?>
            <p class="title">トレードしたいアイテム：</p>
            <p class="contents"><?php print h($item['trade_item']); ?></p>
            <?php if($user["user_id"] === $item["user_id"]){ ?>
                <button type="button" class="btn btn-lg btn-warning btn-block" disabled>トレードリクエスト送信</button>
            <?php }else if($detail === "detail"){ ?>
                <form action="trade_request.php" method="get">
                    <input type="submit" value="トレードリクエストへ戻る" class="btn btn-outline-info btn-block">
                    <input type="hidden" name="detail" value="detail">
                    <input type="hidden" name="csrf_token" value="<?=$token?>">
                </form>
            <?php }else if($trade_success_check > 0){?>
                <button type="button" class="btn btn-lg btn-secondary btn-block" disabled>トレード済みアイテム</button>
            <?php } else{?>
                <form action="item_select.php" method="get">
                    <input type="submit" value="トレードリクエスト送信" class="btn btn-warning btn-block">
                    <input type="hidden" name="item_id" value="<?php print h($item['item_id']); ?>">
                    <input type="hidden" name="user_id" value="<?php print h($item['user_id']); ?>">
                    <input type="hidden" name="csrf_token" value="<?=$token?>">
                </form>
            <?php } ?>
        </div>
        </div>
    </div>
    </div>
    </body>
</html>