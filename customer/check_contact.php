<?php session_start(); ?>
<?php require '../script/php/header.php'; ?>
<header>
	<title>check_contact|〇〇〇</title>
	<link rel="stylesheet" type="text/css" href="../scripts/css/style_t.css">
</header>
<!-- ヘッダー ここまで-->

<!-- メイン -->
<?php
$pdo = new PDO('mysql:host=localhost;dbname=store;charset=utf8', 'staff', 'password');
if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/", $_REQUEST['email'])) {
	echo 'メールアドレスに使用できない文字が含まれているか<br/>';
	echo '@が含まれていない可能性があります。<br/>';
	echo '<form action="contact.php" method="post">';
	echo '<input type="submit" value="戻る" class="button">';
	echo '</form>';
} else {
	date_default_timezone_set('Japan');
	$date = date('Y-m-d');
	$sql = $pdo->prepare('insert into contact value(null,?,?,?,?,?,?,?)');
	$sql->execute([
		$date,
		$_REQUEST['contact_customer_type'],
		$_REQUEST['name'],
		$_REQUEST['email'],
		$_REQUEST['support_status'],
		$_REQUEST['contact_title'],
		$_REQUEST['contact_contents'],
	]);
}
?>
<main>
	<div class="check_contact">
		<div>
			<h2>問い合わせ内容が送信されました。</h2>
			<p>担当者から折り返しご連絡差し上げます。</p>
		</div>
		<div>
			<form action="index.php" method="post">
				<input type="submit" value="TOPに戻る" class="button">
			</form>
		</div>
	</div>
</main>
<!-- メイン ここまで-->
<?php require '../script/php/footer.php'; ?>