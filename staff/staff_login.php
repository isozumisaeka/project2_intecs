<?php session_start();?>
<?php $title = 'ログイン管理画面TOP';?>
<?php require '../script/php/our_functions.php';?>
<?php require '../script/php/staff_header.php';?>
<?php

if(isset($_REQUEST['login'])and isset($_REQUEST['password'])){
	unset($_SESSION['staff']);
	$pdo= new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
	$sql = $pdo->prepare('select * from staff where login=? and password=?');
	$sql->execute([
		$_REQUEST['login'],
		$_REQUEST['password']
	]);

	foreach($sql as $row){
		$_SESSION['staff']=[
			'id'=>$row['staff_id'], 'login'=>$row['login'], 'password'=>$row['password']
		];
	}

	if(isset($_SESSION['staff'])){
		echo 'ログインしました';
	}else{
		echo '<form action="staff_login.php" method="post">';
		echo 'ログイン名';
		echo '<input type="text" name="login">';
		echo 'パスワード';
		echo '<input type="password" name="password">';
		echo '<input type="submit" value="ログイン">';
		echo '</form>';
	}
}else{
	unset($_SESSION['staff']);
	echo 'ログアウトしました';
}
?>
<?php require '../script/php/staff_footer.php';?>