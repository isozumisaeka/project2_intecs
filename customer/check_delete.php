<?php session_start();?>
<?php $title = 'check_delete | hinna';?>
<?php require '../script/php/header.php'; ?>
<main>
	<h1>Your Account is deleted!</h1>

<?php
	$pdo=new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
	if(isset($_SESSION['customer'])){
		$sql=$pdo->prepare('update customer set available=0 where customer_id=?');
		$sql->execute([$_REQUEST['customer_id']]);
			echo '<p>お客様情報を削除しました。</p>';
			echo '<p>またのご登録をお待ちしています。</p>';
			echo '<form action="index.php" method="post">';
			echo '<input type="submit" value="トップへ" class="button">';
			echo '</form>';
	}else{
			echo '<p>ログイン後、再度行ってください。</p>';
			echo '<form action="login.php" method="post">';
			echo '<input type="submit" value="ログインページへ" class="button">';
			echo '</form>';
	}
?>

</main>
<?php require '../script/php/footer.php'; ?>