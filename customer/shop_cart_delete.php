<?php session_start(); ?>
<?php $title = '商品削除｜hinna'; ?>
<?php require '../script/php/header.php'; ?>
<?php

unset($_SESSION['product'][$_REQUEST['product_id']]);
echo '<h1>Product has been removed!</h3>';
echo '<p>カートから商品を削除しました</p>';

require 'shop_cart_content.php';

?>


<?php require '../script/php/footer.php'; ?>