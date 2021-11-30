<?php session_start();?>
<?php $title = 'スタッフリスト';?>
<?php require '../script/php/our_functions.php';?>
<?php require '../script/php/staff_header.php';?>
<?php
if(isset($_SESSION['staff'])){
	$table_titles=[
		'店員番号',
		'ログイン名',
		'パスワード',
	];

	$data_keys=[
		'staff_id',
		'login',
		'password',
	];

	$isEditable=[
		'staff_id'=>false,
		'login'=>true,
		'password'=>true,
	];
	$pdo= new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
	echo '<h2>スタッフリスト</h2>';

	if(isset($_REQUEST['command'])){
		switch($_REQUEST['command']){
			case 'insert':
				$sql = $pdo->prepare('select login from staff where login = ?');
				if(empty($sql->execute([$_REQUEST['login']]))){
					echo '既に使用済みのログイン名です。';
					echo '<hr>';
					break;
				}else if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,}$/', $_REQUEST['password'])){
					echo '不適切なパスワードです';
					echo '<hr>';
					break;

				}else{

					$sql = $pdo->prepare('insert into staff values(null,?,?)');
					$sql->execute([
						$_REQUEST['login'],
						$_REQUEST['password']
					]);
					echo 'スタッフを追加しました。';
					echo '<hr>';
				}break;

			case 'update':
				$sql = $pdo->prepare('select login from staff where login = ? 
					and staff_id <> ?');
				if(empty($sql->execute([$_REQUEST['login'],$_REQUEST['staff_id']]))){
					echo '既に使用済みのログイン名です。';
					echo '<hr>';
					break;
				}else if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,}$/', $_REQUEST['password'])){
					echo '不適切なパスワードです';
					echo '<hr>';
					break;

				}else{

					$sql = $pdo->prepare('update staff set 
						login = ?,
						password = ?
						where staff_id = ?');
					$sql->execute([
						$_REQUEST['login'],
						$_REQUEST['password'],

						$_REQUEST['staff_id']
					]);
					echo 'スタッフ情報を編集しました。';
					echo '<hr>';
				}break;

			case 'delete':
				if($_REQUEST['staff_id'] != 1){
					$sql = $pdo->prepare('delete from staff where staff_id = ?');
					$sql->execute([$_REQUEST['staff_id']]);
					echo 'スタッフを削除しました。';
				}else{
					echo 'このスタッフは削除することができません。';
				}
				echo '<hr>';
				break;


		}
	}

	echo '<form action="staff_add_staff.php" method="post">';
	if(isset($_REQUEST['isEdit']) and $_REQUEST['isEdit']=="true"){
		echo '<input type="hidden" name="isEdit" value="false">';
		echo '<input type="submit" value="編集完了">';
	}else{
		echo '<input type="hidden" name="isEdit" value="true">';
		echo '<input type="submit" value="編集">';
	}
	echo '</form>';

	$sql=$pdo->prepare('select * from staff');
	$sql->execute([]);
	if(isset($_REQUEST['isEdit']) and $_REQUEST['isEdit']=="true"){
		editDataTable($table_titles,$sql,$data_keys,$isEditable,'staff_add_staff.php');
	}else{
		showDataTable($table_titles,$sql,$data_keys);
	}
}else{
	echo '<form action="staff_login.php" method="post">';
		echo 'ログイン名';
		echo '<input type="text" name="login">';
		echo 'パスワード';
	echo '<input type="password" name="password">';
	echo '<input type="submit" value="ログイン">';
	echo '</form>';
}
?>
<?php require '../script/php/staff_footer.php';?>