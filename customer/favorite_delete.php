<?php session_start();?>
<?php $title = 'favorite_delete | hinna';?>
<?php require '../script/php/header.php'; ?>
<main>
<?php
if(isset($_REQUEST['id'])){

	if (isset($_SESSION['customer'])) {
		$pdo=new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
		$sql=$pdo->prepare('delete from favorite where customer_id=? and product_id=?');
		$sql->execute([$_SESSION['customer']['customer_id'], $_REQUEST['id']]);
		echo '<h1>Product has been removed!</h3>';
		echo '<p>お気に入りから商品を削除しました。</p>';
		// echo '<hr>';
	} else {
		echo '<h1>Error!</h1>';
		echo '<p>お気に入りから商品を削除するには、ログインしてください。</p>';
	}
}else{
	echo '<h1>Error!</h1>';
	echo '<p>不明の商品です。</p>';
	echo '<a href="index.php" class="button">TOPへ</a>';
}
require 'favorite_main.php';
?>
</main>
<?php require '../script/php/footer.php'; ?>