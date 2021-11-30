<?php session_start();?>
<?php $title = '問い合わせキャンセル確認画面';?>
<?php require '../script/php/our_functions.php';?>
<?php require '../script/php/staff_header.php';?>
<?php
if(isset($_SESSION['staff'])){
	$table_titles=[
		'お問い合わせ番号',
		'お問い合わせ日',
		'お問い合わせ者区分',
		'お問い合わせ者',
		'お問い合わせ者連絡先',
		'対応状況',
		'お問い合わせタイトル',
		'お問い合わせ内容'
	];

	$data_keys=[
		'contact_id',
		'contact_date',
		'contact_customer_type',
		'contact_customer',
		'contact_customer_mail',
		'support_status',
		'contact_title',
		'contact_contents'
	];

	$isEditable=[
		'contact_id'=>false,
		'contact_date'=>true,
		'contact_customer_type'=>true,
		'contact_customer'=>true,
		'contact_customer_mail'=>true,
		'support_status'=>true,
		'contact_title'=>true,
		'contact_contents'=>true
	];
	$pdo= new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
	echo '<h2>',$title,'</h2>';

	if(isset($_REQUEST['command'])){
		switch($_REQUEST['command']){
			case 'update':
				if(empty($_REQUEST['contact_date'])){
					echo 'お問い合わせ日を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['contact_customer_type'])){
					echo 'お問い合わせ者区分を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['contact_customer'])){
					echo 'お問い合わせ者を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['contact_customer_mail'])){
					echo 'お問い合わせ者メールを入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['support_status'])){
					echo '対応状況を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['contact_title'])){
					echo 'お問い合わせタイトルを入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['contact_contents'])){
					echo 'お問い合わせ内容を入力してください。';
					echo '<hr>';
					break;
				}else{

					$sql = $pdo->prepare('update contact set 
						contact_date=?,
						contact_customer_type=?,
						contact_customer=?,
						contact_customer_mail=?,
						support_status=?,
						contact_title=?,
						contact_contents=?

						where contact_id = ?');
					$sql->execute([
						$_REQUEST['contact_date'],
						$_REQUEST['contact_customer_type'],
						$_REQUEST['contact_customer'],
						$_REQUEST['contact_customer_mail'],
						$_REQUEST['support_status'],
						$_REQUEST['contact_title'],
						$_REQUEST['contact_contents'],

						$_REQUEST['contact_id']
					]);
					echo '対応情報を編集しました。';
					echo '<hr>';
				}break;


			case 'insert':
				if(empty($_REQUEST['contact_date'])){
					echo 'お問い合わせ日を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['contact_customer_type'])){
					echo 'お問い合わせ者区分を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['contact_customer'])){
					echo 'お問い合わせ者を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['contact_customer_mail'])){
					echo 'お問い合わせ者メールを入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['support_status'])){
					echo '対応状況を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['contact_title'])){
					echo 'お問い合わせタイトルを入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['contact_contents'])){
					echo 'お問い合わせ内容を入力してください。';
					echo '<hr>';
					break;
				}else{

					
					$sql = $pdo->prepare('insert into contact values(null,?,?,?,?,?,?,?)');
					$sql->execute([
						$_REQUEST['contact_date'],
						$_REQUEST['contact_customer_type'],
						$_REQUEST['contact_customer'],
						$_REQUEST['contact_customer_mail'],
						$_REQUEST['support_status'],
						$_REQUEST['contact_title'],
						$_REQUEST['contact_contents']
					]);
					echo '対応情報を編集しました。';
					echo '<hr>';
				}break;


			case 'delete':
				$sql = $pdo->prepare('delete from contact where contact_id = ?');
				$sql->execute([$_REQUEST['contact_id']]);
				echo '問い合わせを削除しました。';
				echo '<hr>';
				break;


		}
	}

	echo '<form action="staff_contact_list.php" method="post">';
	if(isset($_REQUEST['isEdit']) and $_REQUEST['isEdit']=="true"){
		echo '<input type="hidden" name="isEdit" value="false">';
		echo '<input type="submit" value="編集完了">';
	}else{
		echo '<input type="hidden" name="isEdit" value="true">';
		echo '<input type="submit" value="編集">';
	}
	echo '</form>';

	$sql=$pdo->prepare('select * from contact');
	$sql->execute([]);
	if(isset($_REQUEST['isEdit']) and $_REQUEST['isEdit']=="true"){
		editDataTable($table_titles,$sql,$data_keys,$isEditable,'staff_contact_list.php');
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