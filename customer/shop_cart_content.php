<h1>Shop Cart</h1>
<?php
if (!isset($_SESSION['customer'])) {
    echo '<br><h1>Error!</h1>';
    echo '<p>購入手続きを行うにはログインしてください</p>';
} else if (!empty($_SESSION['product'])) {
    echo '<form action="shop_cart_purchased.php" method="post" class="product_table send">';
    echo '<table>';
    echo '<th>商品番号</th><th>商品名</th><th>価格</th><th>個数</th><th>小計</th>';
    $total = 0;
    $cartArray = [];
    $cartCount = [];
    $loop_count = 0;
    foreach ($_SESSION['product'] as $product_id => $product) {
        echo '<tr>';
        echo '<td>' . $product_id . '</td>';
        echo '<td><a href="detail.php?product_id=' . $product_id . '">' . $product['name'] . '</a></td>';
        echo '<td>¥' . number_format($product['price']) . '-</td>';
        echo '<td>' . $product['count'] . '</td>';
        $subtotal = $product['price'] * $product['count'];
        $total += $subtotal;
        echo '<td>¥' . number_format($subtotal) . '-</td>';
        echo '<td><a href="shop_cart_delete.php?product_id=' . $product_id . '" class="button" style="width:60px">削除</a></td>';
        echo '</tr>';
        $cartArray[] = $product_id;
        $cartCount[] = $product['count'];

        // ここで購入する商品のIDと個数をshop_cart_purchase.phpに送っている。
        echo '<input type="hidden" name="cartArray[', $loop_count, '][product_id]" value="', $product_id, '">';
        echo '<input type="hidden" name="cartArray[', $loop_count, '][count]" value="', $product['count'], '">';
        $loop_count += 1;
    }
    echo '<tr><td>合計</td><td></td><td></td><td></td><td>¥' . number_format($total) . '-</td><td></td></tr>';
    echo '</table>';
    echo '<input type="submit" value="購入する" class="button">';
    echo '</form>';
} else {
    // echo '<br><h1>Error!</h1>';
    echo '<p>カートに商品はありません</p>';
}
echo '<form action="product_list.php" method="post">';
echo '<input type="submit" value="商品一覧に戻る" class="button">';
echo '</form>';
?>