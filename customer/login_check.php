<?php session_start(); ?>
<?php $title = 'login_check | hinna'; ?>
<?php require '../script/php/header.php'; ?>
<main>
	<?php
	unset($_SESSION['customer']);
	$pdo = new PDO('mysql:host=localhost;dbname=store;charset=utf8', 'staff', 'password');
	$sql = $pdo->prepare('select * from customer where login=? and password=?');
	$sql->execute([$_REQUEST['login'], $_REQUEST['password']]);
	foreach ($sql as $row) {
		if ($row['available'] == 1) {
			$_SESSION['customer'] = [
				'customer_id' => $row['customer_id'],
				'customer_name' => $row['customer_name'],
				'customer_address' => $row['customer_address'],
				'e_mail_address' => $row['e_mail_address'],
				'tel_number' => $row['tel_number'],
				'login' => $row['login'],
				'password' => $row['password'],
				'available' => $row['available']
			];
		}
	}
	if (isset($_SESSION['customer'])) {
		if ($_SESSION['customer']['available'] == 1) {
			echo '<h1>Congratulations!</h1>';
			echo '<p>ようこそ、', $_SESSION['customer']['customer_name'], 'さん</p>';
			echo '<p>ログインに成功しました。</p>';
			echo '<form action="mypage.php" method="post" >';
			echo '<input type="submit" value="マイページへ" class="button">';
			echo '<form action="index.php" method="post" >';
			// echo '<input type="submit" value="ホームへ" class="button">';
		} else if ($_SESSION['customer']['available'] == 0) {
			echo '<h1>Error!</h1>';
			echo '<p>このログイン名のアカウントがありません。</p>';
			echo '<form action="mypage.php" method="post" >';
			echo '<input type="submit" value="マイページへ" class="button">';
			echo '<form action="index.php" method="post" >';
			// echo '<input type="submit" value="ホームへ" class="button">';
		}
	} else {
		// hタグ追加　クラス追加
		echo '<h1>Error!</h1>';
		echo '<p>ログイン名またはパスワードが間違っています。</p>';
		echo '<form action="login.php" method="post" >
			<input type="submit" value="ログイン画面へ" class="button">';
	}
	?>




</main>
<?php require '../script/php/footer.php'; ?>