<?php session_start();?>
<?php $title = '在庫管理画面';?>
<?php require '../script/php/our_functions.php';?>
<?php require '../script/php/staff_header.php';?>
<?php
if(isset($_SESSION['staff'])){
	$table_titles=[
		'商品番号',
		'商品名',
		'単価',
		'在庫',
		'検索カテゴリ',
		'サイズ',
		'商品画像パス'
	];

	$data_keys=[
		'product_id',
		'product_name',
		'price',
		'stock',
		'search_category',
		'product_size',
		'product_image'
	];

	$isEditable=[
		'product_id'=>false,
		'product_name'=>true,
		'price'=>true,
		'stock'=>true,
		'search_category'=>true,
		'product_size'=>true,
		'product_image'=>true
	];
	$pdo= new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
	echo '<h2>',$title,'</h2>';

	if(isset($_REQUEST['command'])){
		switch($_REQUEST['command']){
			case 'insert':
				if(empty($_REQUEST['product_name'])){
					echo '商品名を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['price'])){
					echo 'お名前を入力してください。';
					echo '<hr>';
					break;
				}else if(!isset($_REQUEST['stock'])){
					echo '在庫数を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['search_category'])){
					echo '検索カテゴリを入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['product_size'])){
					echo '商品サイズを入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['product_image'])){
					echo '商品画像のファイル名を入力してください。';
					echo '<hr>';
					break;
				}else{

					$sql = $pdo->prepare('insert into product values(null,?,?,?,?,?,?)');
					$sql->execute([
						$_REQUEST['product_name'],
						$_REQUEST['price'],
						$_REQUEST['stock'],
						$_REQUEST['search_category'],
						$_REQUEST['product_size'],
						$_REQUEST['product_image']

					]);
					echo '商品情報を追加しました。';
					echo '<hr>';
				}break;

			case 'update':
				if(empty($_REQUEST['product_name'])){
					echo '商品名を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['price'])){
					echo 'お名前を入力してください。';
					echo '<hr>';
					break;
				}else if(!isset($_REQUEST['stock'])){
					echo '在庫数を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['search_category'])){
					echo '検索カテゴリを入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['product_size'])){
					echo '商品サイズを入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['product_image'])){
					echo '商品画像のファイル名を入力してください。';
					echo '<hr>';
					break;
				}else{
					$sql = $pdo->prepare('update product set 
						product_name = ?,
						price = ?,
						stock = ?,
						search_category = ?,
						product_size = ?,
						product_image = ?
						where product_id = ?');
					$sql->execute([
						$_REQUEST['product_name'],
						$_REQUEST['price'],
						$_REQUEST['stock'],
						$_REQUEST['search_category'],
						$_REQUEST['product_size'],
						$_REQUEST['product_image'],

						$_REQUEST['product_id']
					]);
					echo '商品情報を編集しました。';
					echo '<hr>';
				}break;

			case 'delete':
				$sql = $pdo->prepare('update product set product_name = ?,stock = 0 
					where product_id = ?');
				$name = $_REQUEST['product_name'].'（販売終了）';
				$sql->execute([$name,$_REQUEST['product_id']]);
				echo '商品在庫を０にしました。';
				echo '<hr>';
				break;


		}
	}

	echo '<form action="staff_stock_list.php" method="post">';
	if(isset($_REQUEST['isEdit']) and $_REQUEST['isEdit']=="true"){
		echo '<input type="hidden" name="isEdit" value="false">';
		echo '<input type="submit" value="編集完了">';
	}else{
		echo '<input type="hidden" name="isEdit" value="true">';
		echo '<input type="submit" value="編集">';
	}
	echo '</form>';

	$sql=$pdo->prepare('select * from product');
	$sql->execute([]);
	if(isset($_REQUEST['isEdit']) and $_REQUEST['isEdit']=="true"){
		editProductTable($table_titles,$sql,$data_keys,$isEditable,'staff_stock_list.php');
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