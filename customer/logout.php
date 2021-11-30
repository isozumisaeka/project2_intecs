<?php session_start();?>
<?php $title = 'logout | hinna';?>
<?php require '../script/php/header.php'; ?>
<main>
		<?php
		if(isset($_SESSION['customer'])){
			unset($_SESSION['customer']);
			echo '<h1>See you!</h1>';
			echo '<p>ログアウトされました。</p>';
			echo '<form action="index.php" method="post">';
			echo '<input type="submit" value="ホームへ" class="button">';
			echo '</form>';
		}else{
			echo '<h1>Error!</h1>';
			echo '<p>ログインされていません。</p><br/>';
			echo '<form action="login.php" method="post">';
			echo '<input type="submit" value="ログイン画面へ" class="button">';
			echo '</form>';
			echo '<form action="index.php" method="post">';
			/*echo '<input type="submit" value="ホームへ" class="button">';*/
			echo '</form>';
		}
		?>
</main>
<?php require '../script/php/footer.php'; ?>