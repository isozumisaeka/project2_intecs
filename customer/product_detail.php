<?php session_start();?>
<?php $title = '商品詳細｜hinna'; ?>
<?php require '../script/php/header.php'; ?>

<?php
if(isset($_REQUEST['product_id'])){

	$pdo = new PDO('mysql:host=localhost;dbname=store;charset=utf8', 'staff', 'password');
	$sql = $pdo->prepare('select * from product where product_id=?');
	$sql->execute([$_REQUEST['product_id']]);
	foreach ($sql as $row) {
		echo '<div class="product_detail">';
		echo '<div class="product_image">';
		echo '<img src="../images/product_images/' . $row['product_image'] . '" alt="">';
		echo '</div>';
		echo '<div class="product_explanation">';
		echo '<form action="shop_cart_insert.php" method="post">';
		echo '<p>商品名</p>';
		echo '<p>' . $row['product_name'] . '</p>';
		echo '<p>商品サイズ</p>';
		echo '<p>' . $row['product_size'] . '</p>';
		echo '<p>金額</p>';
		echo '<p>¥' . number_format($row['price']) . '-</p>';
		echo '<p>購入数</p>';
		echo '<p><select name="count">';
		for ($i = 1; $i <= 10; $i++) {
			echo '<option value="' . $i . '">' . $i . '</option>';
		}
		echo '</select></p>';
		echo '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';
		echo '<input type="hidden" name="product_name" value="' . $row['product_name'] . '">';
		echo '<input type="hidden" name="product_size" value="' . $row['product_size'] . '">';
		echo '<input type="hidden" name="price" value="' . $row['price'] . '">';
		echo '<input type="submit" value="カートへ追加" class="button" style="width:200px">';
		echo '</form>';

		// echo $row['product_id'];

		echo '<form action="product_list.php" method="post">';
		echo '<input type="submit" value="商品一覧に戻る" class="button" style="width:200px">';
		echo '</form>';
		echo '<a href="favorite_insert.php?id=',$row['product_id'],'" class="button" style="width:200px">お気に入りに追加</a> ';
		echo '</div>';
		echo '</div>';
	}
}else{
	echo '<h1>Error!</h1>';
	echo '<p>不明の商品です。</p>';
	echo '<a href="index.php" class="button">TOPへ</a>';
}
?>
	<?php require '../script/php/footer.php'; ?>