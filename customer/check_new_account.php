<?php session_start();?>
<?php $title = 'check_new_account | hinna';?>
<?php require '../script/php/header.php'; ?>
<main>
	<h2 class="">User登録</h2>

<?php
	$pdo=new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
	if(!isset($_SESSION['customer'])){
	// 	$id=$_SESSION['customer']['customer_id'];
	// 	$sql=$pdo->prepare('select * from customer where customer_id!=? and login=?'); 
	// 	$sql->execute([$id,$_REQUEST['login']]);
	// }else{
		$sql=$pdo->prepare('select * from customer where login=?'); 
		$sql->execute([$_REQUEST['login']]);
	
		if(empty($sql->fetchAll())){
			if(!preg_match('/^[0-9]{10}[0-9]?$/', $_REQUEST['tel'])){
				echo '電話番号が間違っています。ー（ハイフン）はない状態で桁数が過不足がないかご確認ください。<br/>';
				echo '<form action="create_new_account.php" method="post">';
				echo '<input type="submit" value="戻る">';
				echo '</form>';
			}else if(
				!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/",
				 $_REQUEST['mail'])){
				echo 'メールアドレスが間違っています。<br/>';
				echo '<form action="create_new_account.php" method="post">';
				echo '<input type="submit" value="戻る">';
				echo '</form>';
			}else if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/', $_REQUEST['password'])){
				echo 'パスワードは半角英数字８文字以上で半角英[a-z]・半角英[A-Z]・半角数字[0-9]を各１文字以上を含んでください。<br/>';
				echo '<form action="create_new_account.php" method="post">';
				echo '<input type="submit" value="戻る">';
				echo '</form>';
			}else {
				$sql=$pdo->prepare('insert into customer value(null,?,?,?,?,?,?,?)');
				$sql->execute([
					$_REQUEST['login'],$_REQUEST['password'],
					$_REQUEST['name'],$_REQUEST['mail'],
					$_REQUEST['tel'],$_REQUEST['address'],
					$_REQUEST['available']
			]);
			}
			unset($_SESSION['customer']);
			$pdo=new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
			$sql=$pdo->prepare('select * from customer where login=? and password=?'); 
			$sql->execute([$_REQUEST['login'],$_REQUEST['password']]);
			foreach ($sql as $row){
				if($row['available']==1){
					$_SESSION['customer']=[
					'customer_id'=>$row['customer_id'],
					'customer_name'=>$row['customer_name'],
					'customer_address'=>$row['customer_address'],
					'e_mail_address'=>$row['e_mail_address'],
					'tel_number'=>$row['tel_number'],
					'login'=>$row['login'],
					'password'=>$row['password'],
					'available'=>$row['available']];
				}
			}
			if(isset($_SESSION['customer'])){
				if($_SESSION['customer']['available']==1){
					echo 'お客様情報を登録しました。';
					echo '<form action="mypage.php" method="post">';
					echo '<input type="submit" value="マイページへ">';
					echo '</form>';
					echo '<form action="index.php" method="post">';
					echo '<input type="submit" value="ホームへ">';
					echo '</form>';
					}
				}
		}
	}else{
	echo 'ログインされています。このログイン名で登録済みです。';
	echo '<form action="mypage.php" method="post">';
	echo '<input type="submit" value="マイページへ">';
	echo '</form>';
	echo '<form action="index.php" method="post">';
	echo '<input type="submit" value="ホームへ">';
	echo '</form>';
	}
?>

</main>
<?php require '../script/php/footer.php'; ?>