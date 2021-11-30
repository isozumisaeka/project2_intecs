<?php session_start();?>
<?php $title = 'favorite_insert | hinna';?>
<?php require '../script/php/header.php'; ?>
<main>
		<?php
		$pdo=new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
		if(isset($_REQUEST['id']))
		{
			if (isset($_SESSION['customer'])) {
				$customer_id=$_SESSION['customer']['customer_id'];
				$sql=$pdo->prepare('select * from favorite where customer_id=? and product_id=?');
				$sql->execute([$customer_id,$_REQUEST['id']]);
				if(empty($sql->fetch())){
					$sql=$pdo->prepare('insert into favorite values(?,?)');
					$sql->execute([$customer_id,$_REQUEST['id']]);
					echo '<h1>Congratulations!</h1>';
					echo '<p>お気に入りに追加しました。</p>';
					echo '<hr>';
					echo '<form action="product_list.php" method="post">';
					echo '<input type="submit" value="商品一覧に戻る" class="button">';
					echo '</form>';
				}else{
					echo '<h1>Error!</h1>';
					echo '<p>この商品はすでにお気に入りに登録されています。</p>';
					echo '<form action="product_list.php" method="post">';
					echo '<input type="submit" value="商品一覧に戻る" class="button">';
					echo '</form>';

				}

			}else{
				echo 'お気に入りに追加するには、ログインしてください。';
			}
		}else{
			echo '不明の商品です。<br>';
			echo '<a href="index.php">TOPへ</a>';
		}
		require 'favorite_main.php';
		?>

</main>
<?php require '../script/php/footer.php'; ?>