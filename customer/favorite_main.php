
	<div class="favorite_table">
		<?php
		if (isset($_SESSION['customer'])) {
			echo '<h1>My Favorite</h1>';
			echo '<table>';
			echo '<th>商品画像</th><th>商品番号</th><th>商品名</th><th>価格</th><th></th>';
			$pdo=new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
			$sql=$pdo->prepare(
				'select favorite.product_id,product_name,price,product_image 
				from favorite left join product on favorite.product_id=product.product_id
				where customer_id=?');
			$sql->execute([$_SESSION['customer']['customer_id']]);

			
			foreach ($sql as $row) {
				$product_id=$row['product_id'];
				$product_image=$row['product_image'];
				echo '<tr>';
				echo '<td class="favorite_table"><img src="../images/product_images/',$product_image,'" alt="favorite_img" style="width:150px"></td>';
				echo '<td>', $product_id, '</td>';
				echo '<td><a href="product_detail.php?id=',$product_id,'">', $row['product_name'], '</a></td>';
				echo '<td>', $row['price'], '</td>';
				echo '<td><a href="favorite_delete.php?id=', $product_id, '" class="button">削除</a></td>';
				echo "\n";
		}
				echo '</table>';
		} else {
			echo '<h1>Error!</h1>';
			echo '<p>お気に入りを表示するには、ログインしてください。<p>';
			echo '<form action="login.php" method="post" >';
			echo '<input type="submit" name="" value="ログイン" class="button">';
			echo '</form>';
		}
		?>
		<!-- <ul class="favorite_list">
				<li class="favorite_01">
					<a href="product_detail.php">
						<p class="favorite_01">
						<img src="../images/product_images/skyer.webp" alt="favorite_01">
						</p> 
						<div class="item01-text">
						<p class="">Dean＆Deluca ペア マグカップ</p>
						<p class="">¥2,500</p>
						</div>
					</a>
				</li>
		</ul> -->
		<form action="mypage.php" method="post" class="send">
			<input type="submit" name="" value="マイページへ戻る" class="button">
		</form>
</div>