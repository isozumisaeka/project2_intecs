<?php $title = '商品一覧｜hinna'; ?>
<?php require '../script/php/header.php'; ?>
<!-- ヘッダーここまで -->
<h1>商品一覧</h1>
<form action="product_list.php" method="post">
	<p class="keyword_search">キーワードで検索する<input type="text" name="keyword">
		<input type="submit" value="検索" class="button">
	</p>
</form>
<form action="product_list.php" method="get">
	<p>ジャンルで検索する
		<input type="radio" name="genre" value="家具">家具
		<input type="radio" name="genre" value="雑貨">インテリア雑貨
		<input type="radio" name="genre" value="食品">食品
		<input type="radio" name="genre" value="食器">食器
		<input type="submit" value="検索" class="button">
	</p>
</form>



<div class="products">
	<?php
	$pdo = new PDO('mysql:host=localhost;dbname=store;charset=utf8', 'staff', 'password');
	if (isset($_REQUEST['keyword'])) {
		$sql = $pdo->prepare('select * from product where product_name like ?');
		$sql->execute(['%' . $_REQUEST['keyword'] . '%']);
	} else if (isset($_REQUEST['genre'])) {
		$sql = $pdo->prepare('select * from product where search_category=?');
		$sql->execute([$_REQUEST['genre']]);
	} else if (isset($_REQUEST['search_category'])) {
		$sql = $pdo->prepare('select * from product where search_category=?');
		$sql->execute([$_REQUEST['search_category']]);
		// echo $_REQUEST['search_category'];
	} else {
		$sql = $pdo->prepare('select * from product');
		$sql->execute([]);
	}

	foreach ($sql as $row) {
		if(!preg_match('/^.+（販売終了）$/', $row['product_name']) ){	
			echo '<div class="product_list">';
			echo '<a href="product_detail.php?product_id=' . $row['product_id'] . '">';
			echo '<img src="../images/product_images/' . $row['product_image'] . '" alt="">';
			echo '<p>' . $row['product_name'] . '</p>';
			// echo '<p>' . $row['product_size'] . '</p>';
			echo '<p>¥' . number_format($row['price']) . '-</p>';
			echo '詳細を見る</a>';
			echo '</div>';
		}
	}
	?>
</div>

<!-- ラジオぼたん -->


<?php require '../script/php/footer.php'; ?>