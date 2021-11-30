<?php session_start();?>
<?php $title = '管理画面TOP';?>
<?php require '../script/php/our_functions.php';?>
<?php require '../script/php/staff_header.php';?>
<?php
if(isset($_SESSION['staff'])){

	$title_array=[
		['staff_customer_list.php','会員情報リスト'],
		['staff_stock_list.php','在庫管理確認'],
		['staff_bill_edit.php','伝票管理'],
		['staff_profit.php','売上確認'],
		['staff_contact_list.php','問い合わせキャンセル確認'],
		['staff_news.php','ニュース等編集'],
		['staff_add_staff.php','新規スタッフ登録']

	];

	foreach($title_array as $row){
		createLink($row);
		echo '<br>';
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