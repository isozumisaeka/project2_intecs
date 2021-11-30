<?php session_start();?>
<?php $title = 'check_update | hinna';?>
<?php require '../script/php/header.php'; ?>
<main>
<?php
	$pdo=new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
	if(isset($_SESSION['customer'])){
		$id=$_SESSION['customer']['customer_id'];
		$sql=$pdo->prepare('select * from customer where customer_id!=? and login=?'); 
		$sql->execute([$id,$_REQUEST['login']]);
	}else{
		$sql=$pdo->prepare('select * from customer where login=?'); 
		$sql->execute([$_REQUEST['login']]);
	}
	if(empty($sql->fetchAll())){
		if(!preg_match('/^[0-9]{10}[0-9]?$/', $_REQUEST['tel'])){
			echo '<h1>Error!</h1>';
			echo '<p>電話番号が間違っています。ー（ハイフン）はない状態で桁数が過不足がないかご確認ください。</p>';
			echo '<form action="update_delete.php" method="post">';
			echo '<input type="submit" value="戻る" class="button">';
			echo '</form>';
		}else if(
			!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/",
			 $_REQUEST['mail'])){
			echo '<h1>Error!</h1>';
			echo '<p>メールアドレスが間違っています。</p>';
			echo '<form action="update_delete.php" method="post">';
			echo '<input type="submit" value="戻る" class="button">';
			echo '</form>';
		}else if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/', $_REQUEST['password'])){
			echo '<h1>Error!</h1>';
			echo '<p>パスワードは半角英数字８文字以上で<br>半角英[a-z]・半角英[A-Z]・半角数字[0-9]を各１文字以上を含んでください。</p>';
			echo '<form action="update_delete.php" method="post">';
			echo '<input type="submit" value="戻る" class="button">';
			echo '</form>';
		}else if(isset($_SESSION['customer'])){
		$sql=$pdo->prepare('update customer set 
			customer_name=?,customer_address=?,
			e_mail_address=?,tel_number=?,
			login=?,password=? where customer_id=?');
		$sql->execute([
			$_REQUEST['name'],$_REQUEST['address'],
			$_REQUEST['mail'],$_REQUEST['tel'],
			$_REQUEST['login'],
			$_REQUEST['password'],
			$id]);
		$_SESSION['customer']=[
			'customer_id'=>$id,
			'customer_name'=>$_REQUEST['name'],
			'customer_address'=>$_REQUEST['address'],
			'e_mail_address'=>$_REQUEST['mail'],
			'tel_number'=>$_REQUEST['tel'],
			'login'=>$_REQUEST['login'],
			'password'=>$_REQUEST['password']];
			echo '<h1>Congratulations!</h1>';
			echo '<p>お客様情報を更新しました。</p>';
			echo '<form action="mypage.php" method="post">';
			echo '<input type="submit" value="マイページへ" class="button">';
			echo '</form>';
		}
	}else{
			echo '<h1>Error!</h1>';
			echo '<p>ログイン名がすでに使用されています。変更してください。</p>';
			echo '<form action="update_delete.php" method="post">';
			echo '<input type="submit" value="戻る" class="button">';
			echo '</form>';
	}
?>

</main>
<?php require '../script/php/footer.php'; ?>