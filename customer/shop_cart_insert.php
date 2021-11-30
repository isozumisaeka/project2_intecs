<?php session_start(); ?>
<?php $title = '商品追加｜hinna'; ?>
<?php require '../script/php/header.php'; ?>
<h1>Now In Cart!</h1>

<?php
$product_id = $_REQUEST['product_id'];
if (!isset($_SESSION['product'])) {
    $_SESSION['product'] = [];
}
$count = 0;
if (isset($_SESSION['product'][$product_id])) {
    $count= $_SESSION['product'][$product_id]['count'];
}
$_SESSION['product'][$product_id] = [
    'name' => $_REQUEST['product_name'],
    'size' => $_REQUEST['product_size'],
    'price' => $_REQUEST['price'],
    'count' => $count + $_REQUEST['count']
];
echo '<p>カートに' . $_REQUEST['count'] . '個の商品を追加しました</p>';

echo '<form action="product_list.php" method="post">';
echo '<input type="submit" value="商品一覧に戻る" class="button">';
echo '</form>';
require 'shop_cart_content.php';

?>


<?php require '../script/php/footer.php'; ?>