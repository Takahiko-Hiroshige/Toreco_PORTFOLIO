<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>アイテム出品</title>
</head>
<body>
  <?php 
  include VIEW_PATH . 'templates/header_logined.php'; 
  ?>

  <div class="container">
    <h1>アイテム出品</h1>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <form 
      method="post" 
      action="item_listing_process.php" 
      enctype="multipart/form-data"
      class="add_item_form col-md-6">
      <div class="form-group">
        <label for="name">アイテム名: </label>
        <input class="form-control" type="text" name="name" id="name">
      </div>
      <div class="form-group">
        <label for="image">商品画像: </label>
        <input type="file" name="image" id="image">
      </div>
      <div class="form-group">
        <label for="item_quality">アイテムの状態: </label>
        <select class="form-control" name="item_quality" id="item_quality">
          <option value="newitem">未開封</option>
          <option value="nobaditem">ほぼ新品</option>
          <option value="baditem">傷あり</option>
        </select>
      </div>
      　<div class="form-group">
        <label for="name">トレードしたいアイテム名を記載: </label>
        <input class="form-control" type="text" name="trade_item_name" id="trade_item_name">
      </div>
      <input type="submit" value="アイテムを出品する" class="btn btn-primary">
      <input type="hidden" name="csrf_token" value="<?=$token?>">
    </form>