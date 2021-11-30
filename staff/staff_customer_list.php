<?php session_start();?>
<?php $title = '会員情報リスト';?>
<?php require '../script/php/our_functions.php';?>
<?php require '../script/php/staff_header.php';?>
<?php
if(isset($_SESSION['staff'])){
	$table_titles=[
		'顧客番号',
		'ログイン名',
		'パスワード',
		'顧客名',
		'Eメールアドレス',
		'電話番号',
		'住所',
		'アカウント状態'
	];

	$data_keys=[
		'customer_id',
		'login',
		'password',
		'customer_name',
		'e_mail_address',
		'tel_number',
		'customer_address',
		'available'
	];

	$isEditable=[
		'customer_id'=>false,
		'login'=>true,
		'password'=>true,
		'customer_name'=>true,
		'e_mail_address'=>true,
		'tel_number'=>true,
		'customer_address'=>true,
		'available'=>true
	];
	$pdo= new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
	echo '<h2>顧客リスト</h2>';

	if(isset($_REQUEST['command'])){
		switch($_REQUEST['command']){
			case 'insert':
				$sql = $pdo->prepare('select login from customer where login = ?');
				$sql->execute([$_REQUEST['login']]);
				if(!empty($sql->fetchAll())){
					echo '既に使用済みのログイン名です。';
					echo '<hr>';
					break;
				}else if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,}$/', $_REQUEST['password'])){
					echo '不適切なパスワードです';
					echo '<hr>';
					break;

				}else if(empty($_REQUEST['customer_name'])){
					echo 'お名前を入力してください。';
					echo '<hr>';
					break;
				}else if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/',$_REQUEST['e_mail_address'])){
					echo '不適切なメールアドレスです';
					echo '<hr>';
				}else if(!preg_match('/^[0-9]{10}[0-9]?$/',$_REQUEST['tel_number'])){
					echo '不適切な電話番号です。';
					echo '<hr>';
				}else if(!($_REQUEST['available']==true or $_REQUEST['available']==false)){
					echo 'アカウント状態にはtrueかfalseを入力してください。';
					echo '<hr>';
					break;
				}else{

					$sql = $pdo->prepare('insert into customer values(null,?,?,?,?,?,?,?)');
					$sql->execute([
						$_REQUEST['login'],
						$_REQUEST['password'],
						$_REQUEST['customer_name'],
						$_REQUEST['e_mail_address'],
						$_REQUEST['tel_number'],
						$_REQUEST['customer_address'],
						$_REQUEST['available']
					]);
					echo '顧客情報を追加しました。';
					echo '<hr>';
				}break;

			case 'update':
				$sql = $pdo->prepare('select * from customer where login = ? 
					and customer_id != ?');
				$sql->execute([$_REQUEST['login'],$_REQUEST['customer_id']]);
				if(!empty($sql->fetchAll())){
					echo '既に使用済みのログイン名です。';
					echo '<hr>';
					break;
				}else if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,}$/', $_REQUEST['password'])){
					echo '不適切なパスワードです';
					echo '<hr>';
					break;

				}else if(empty($_REQUEST['customer_name'])){
					echo 'お名前を入力してください。';
					echo '<hr>';
					break;
				}else if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/',$_REQUEST['e_mail_address'])){
					echo '不適切なメールアドレスです';
					echo '<hr>';
				}else if(!preg_match('/^[0-9]{10}[0-9]?$/',$_REQUEST['tel_number'])){
					echo '不適切な電話番号です。';
					echo '<hr>';
				}else if(!($_REQUEST['available']==true or $_REQUEST['available']==false)){
					echo 'アカウント状態にはtrueかfalseを入力してください。';
					echo '<hr>';
					break;
				}else{

					$sql = $pdo->prepare('update customer set 
						login = ?,
						password = ?,
						customer_name = ?,
						e_mail_address = ?,
						tel_number = ?,
						customer_address = ?,
						available = ?
						where customer_id = ?');
					$sql->execute([
						$_REQUEST['login'],
						$_REQUEST['password'],
						$_REQUEST['customer_name'],
						$_REQUEST['e_mail_address'],
						$_REQUEST['tel_number'],
						$_REQUEST['customer_address'],
						$_REQUEST['available'],

						$_REQUEST['customer_id']
					]);
					echo '顧客情報を編集しました。';
					echo '<hr>';
				}break;

			case 'delete':
				$sql = $pdo->prepare('update customer set available = false where customer_id = ?');
				$sql->execute([$_REQUEST['customer_id']]);
				echo 'アカウントを停止しました。';
				echo '<hr>';
				break;


		}
	}

	echo '<form action="staff_customer_list.php" method="post">';
	if(isset($_REQUEST['isEdit']) and $_REQUEST['isEdit']=="true"){
		echo '<input type="hidden" name="isEdit" value="false">';
		echo '<input type="submit" value="編集完了">';
	}else{
		echo '<input type="hidden" name="isEdit" value="true">';
		echo '<input type="submit" value="編集">';
	}
	echo '</form>';

	$sql=$pdo->prepare('select * from customer');
	$sql->execute([]);
	if(isset($_REQUEST['isEdit']) and $_REQUEST['isEdit']=="true"){

		showTitles($table_titles);
		echo '<br>';

		foreach($sql as $row){
			echo '<form class="ib" action="staff_customer_list.php" method="post">';
			echo '<input type="hidden" name="command" value="update">';
			foreach($data_keys as $key){
				if($isEditable[$key]){
					echo '<div class="tableItems">';
					echo '<input type="text" name="',$key,'" value="',$row[$key],'">';
					echo '</div>'; 
				}else{
					echo '<div class="tableItems">';
					echo '<input type="hidden" name="',$key,'" value="',$row[$key],'">';
					echo $row[$key];
					echo '</div>';
				}
			}
			echo '<input type="submit" value="更新">';
			echo '</form>';

			echo '<form class="ib" action="staff_customer_list.php" method="post">';
			echo '<input type="hidden" name="command" value="delete">';
			echo '<input type="hidden" name="',$data_keys[0];
			echo '" value="';
			echo $row[$data_keys[0]],'">';
			echo '<input type="submit" value="アカウント停止">';
			echo '</form>';
			echo '<br>';
		}
		echo '<form action="staff_customer_list.php" method="post">';
		echo '<input type="hidden" name="command" value="insert">';
		foreach($data_keys as $key){
			if($isEditable[$key]){
				echo '<div class="tableItems">';
				echo '<input type="text" name="',$key,'" value="">';
				echo '</div>'; 
			}else{
				echo '<div class="tableItems">';
				echo '入力不可';
				echo '</div>';
			}
		}
		echo '<input type="submit" value="追加">';
		echo '</form>';
	



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