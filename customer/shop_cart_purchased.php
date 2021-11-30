<?php session_start(); ?>
<?php $title='購入完了｜hinna';?>
<?php require '../script/php/header.php'; ?>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=store;charset=utf8', 'staff', 'password');
$bill_id=1;
date_default_timezone_set('Japan');
$purchase_date=date('Y-m-d');
// foreach($pdo->query('select max(bill_id) from bill') as $row){
// $bill_id=$row['max(bill_id)']+1;
// }
$sql= $pdo->prepare('insert into bill values(null,?,?)');
if($sql->execute([$_SESSION['customer']['customer_id'],$purchase_date])){
	foreach($_REQUEST['cartArray'] as $cartItem){
		$sql=$pdo->prepare('select stock from product where product_id=?');
		$sql->execute([$cartItem['product_id']]);
		foreach ($sql as $row) {
			$stock=$row['stock'];
		}
		if(!isset($stock)){
			echo '<h1>Error!</h1>';
			echo '<p>エラーが発生しました。存在しない商品番号です。</p>';
			echo '<form action="product_list.php" method="post">';
			echo '<input type="submit" value="商品一覧に戻る" class="button">';
			echo '</form>';

		}else{
			if($cartItem['count']<=$stock){
				foreach($pdo->query('select max(bill_id) from bill') as $row){
						$bill_id=$row['max(bill_id)'];
					}
				$sql=$pdo->prepare('insert into bill_detail values(?,?,?,?)');
				$sql->execute([$bill_id, $cartItem['product_id'], $cartItem['count'],'発送準備中']);
				$sql=$pdo->prepare('update product set stock=? where product_id=?');
				$sql->execute([($stock-$cartItem['count']),$cartItem['product_id']]);
			}else{
				echo '<h1>Error!</h1>';
				echo '<p>在庫が足りませんでした</p>';
				echo '<form action="product_list.php" method="post">';
				echo '<input type="submit" value="商品一覧に戻る" class="button">';
				echo '</form>';
			}
		}
	}
	unset($_SESSION['product']);
		echo '<h1>Congraturations!</h1>';
		echo '<p>購入手続きが完了しました。</p>';
		echo '<form action="mypage.php" method="post">';
		echo '<input type="submit" value="マイページへ" class="button">';
		echo '</form>';
}else{
		echo '<h1>Error!</h1>';
		echo '<p>購入手続き中にエラーが発生しました。もう一度やり直してください。</p>';
		echo '<form action="product_list.php" method="post">';
		echo '<input type="submit" value="商品一覧に戻る" class="button">';
		echo '</form>';
}


?>

<?php require '../script/php/footer.php'; ?>