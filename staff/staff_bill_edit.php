<?php session_start();?>
<?php $title = '伝票管理画面'; $thisPage = 'staff_bill_edit.php'?>
<?php require '../script/php/our_functions.php';?>
<?php require '../script/php/staff_header.php';?>
<?php
if(isset($_SESSION['staff'])){
	$pdo= new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
	echo '<h2>',$title,'</h2>';

	if(isset($_REQUEST['command'])){
		switch($_REQUEST['command']){
			case 'insert':
				if(empty($_REQUEST['product_id'])){
					echo '商品番号を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['purchase_number'])){
					echo '購入数を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['delivery_status'])){
					echo '発送状況を入力してください。';
					echo '<hr>';
					break;
				}else{

					$sql = $pdo->prepare('insert into bill_detail values(?,?,?,?)');
					$sql->execute([
						$_REQUEST['bill_id'],
						$_REQUEST['product_id'],
						$_REQUEST['purchase_number'],
						$_REQUEST['delivery_status'],

					]);
					echo '伝票詳細を追加しました。';
					echo '<hr>';
				}break;

			case 'update':
				if(empty($_REQUEST['product_id'])){
					echo '商品番号を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['purchase_number'])){
					echo '購入数を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['delivery_status'])){
					echo '発送状況を入力してください。';
					echo '<hr>';
					break;
				}else{
					$sql = $pdo->prepare('update bill_detail set 
						product_id=?,
						purchase_number=?,
						delivery_status	= ?

						where bill_id = ? and product_id=?');
					$sql->execute([
						$_REQUEST['product_id'],
						$_REQUEST['purchase_number'],
						$_REQUEST['delivery_status'],

						$_REQUEST['bill_id'],
						$_REQUEST['product_id']
					]);
					echo '伝票詳細を編集しました。';
					echo '<hr>';
				}break;

			case 'delete':
				$sql = $pdo->prepare('delete from bill_detail where bill_id = ?and product_id = ?');
				$sql->execute([$_REQUEST['bill_id'],$_REQUEST['product_id']]);
				echo '伝票から商品を削除しました。';
				echo '<hr>';
				break;

			case 'bill_insert':
				if(empty($_REQUEST['customer_id'])){
					echo '顧客番号を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['purchase_date'])){
					echo '購入日を入力してください。';
					echo '<hr>';
					break;
				}else{

					$sql = $pdo->prepare('insert into bill values(null,?,?)');
					$sql->execute([
						$_REQUEST['customer_id'],
						$_REQUEST['purchase_date']

					]);
					echo '受注伝票を追加しました。';
					echo '<hr>';
				}break;

			case 'bill_update':
				if(empty($_REQUEST['customer_id'])){
					echo '顧客番号を入力してください。';
					echo '<hr>';
					break;
				}else if(empty($_REQUEST['purchase_date'])){
					echo '購入日を入力してください。';
					echo '<hr>';
					break;
				}else{
					$sql = $pdo->prepare('update bill set 
						customer_id=?,
						purchase_date	= ?

						where bill_id = ?');
					$sql->execute([
						$_REQUEST['customer_id'],
						$_REQUEST['purchase_date'],

						$_REQUEST['bill_id']
					]);
					echo '受注伝票を編集しました。';
					echo '<hr>';
				}break;

			case 'bill_delete':
				$sql = $pdo->prepare('delete from bill_detail where bill_id = ?');
				$sql->execute([$_REQUEST['bill_id']]);
				$sql = $pdo->prepare('delete from bill where bill_id = ?');
				$sql->execute([$_REQUEST['bill_id']]);
				echo '受注伝票を削除しました。';
				echo '<hr>';
				break;

		}
	}

/////////////////////////////////////////////////////////////////////////////

	$bill_keys=[
		'bill_id',
		'customer_id',
		'customer_name',
		'purchase_date'
	];

	$table_titles=[
		'商品番号',
		'商品名',
		'商品単価',
		'数量',
		'商品合計金額',
		'発送状況'
	];

	$data_keys=[
		'product_id',
		'product_name',
		'price',
		'purchase_number',
		'product.price*purchase_number',
		'delivery_status'
	];

	$isEditable=[
		'product_id'=>true,
		'product_name'=>false,
		'price'=>false,
		'purchase_number'=>true,
		'product.price*purchase_number'=>false,
		'delivery_status'=>true

	];
	$sql_bill=$pdo->prepare('select bill_id,bill.customer_id,customer_name,purchase_date from bill
		left join customer on bill.customer_id=customer.customer_id');
	$sql_bill->execute([]);


	echo '<form action="staff_bill_edit.php" method="post">';
	if(isset($_REQUEST['isEdit']) and $_REQUEST['isEdit']=="true"){
		echo '<input type="hidden" name="isEdit" value="false">';
		echo '<input type="submit" value="編集完了">';
	}else{
		echo '<input type="hidden" name="isEdit" value="true">';
		echo '<input type="submit" value="編集">';
	}
	echo '</form>';
	echo '<hr>';

	if(isset($_REQUEST['isEdit']) and $_REQUEST['isEdit']=="true"){
		echo '新規伝票を追加<br>';

		echo '<form class="ib" action="',$thisPage,'" method="post">';
		echo '<input type="hidden" name="command" value="bill_insert">';

		echo '<div class="tableItems">';
		echo '顧客番号';
		echo '<input type="text" name="customer_id" value="">';
		echo '</div>'; 

		echo '<div class="tableItems">';
		echo '購入日';
		echo '<input type="text" name="purchase_date" value="">';
		echo '</div>'; 
		echo '<input type="submit" value="新規伝票を追加">';
		echo '</form>';

		echo '<hr>';
	}
	foreach($sql_bill as $bill){
		echo '伝票番号';
		if(isset($_REQUEST['isEdit']) and $_REQUEST['isEdit']=="true"){

			echo '<form class="ib" action="',$thisPage,'" method="post">';
			echo '<input type="hidden" name="command" value="bill_update">';
			echo '<input type="hidden" name="bill_id" ';
			echo 'value="',$bill['bill_id'],'">';

			echo '顧客番号';

			echo '<div class="tableItems">';
			echo '<input type="text" name="customer_id" value="',$bill['customer_id'],'">';
			echo '</div>'; 

			echo '<div class="tableItems">';
			echo $bill['customer_name'];
			echo '</div>';

			echo '<div class="tableItems">';
			echo '<input type="text" name="purchase_date" value="',$bill['purchase_date'],'">';
			echo '</div>'; 
				
			echo '<input type="submit" value="伝票を更新">';
			echo '</form>';


			echo '<form class="ib" action="',$thisPage,'" method="post">';
			echo '<input type="hidden" name="command" value="bill_delete">';
			echo '<input type="hidden" name="bill_id" ';
			echo 'value="';
			echo $bill['bill_id'],'">';
			echo '<input type="submit" value="伝票を削除">';
			echo '</form>';
			echo '<br>';
		}else{
			foreach($bill_keys as $key){
				if($key == 'customer_id'){
					echo '顧客番号';
				}
				echo $bill[$key];
				echo '&nbsp; ';
			}
		}

		$sql_detail=$pdo->prepare('select 
		bill_detail.product_id,
		product_name,
		price,
		purchase_number,
		product.price*purchase_number,
		delivery_status
		from bill_detail
	 	left join product on bill_detail.product_id=product.product_id
	 	where bill_id = ?
		 ');
		$sql_detail->execute([$bill['bill_id']]);
		if(isset($_REQUEST['isEdit']) and $_REQUEST['isEdit']=="true"){

			showTitles($table_titles);
			echo '<br>';

			foreach($sql_detail as $row){
				echo '<form class="ib" action="',$thisPage,'" method="post">';
				echo '<input type="hidden" name="command" value="update">';
				echo '<input type="hidden" name="bill_id" ';
				echo 'value="',$bill['bill_id'],'">';
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

				echo '<form class="ib" action="',$thisPage,'" method="post">';
				echo '<input type="hidden" name="command" value="delete">';
				echo '<input type="hidden" name="bill_id" ';
				echo 'value="',$bill['bill_id'],'">';
				echo '<input type="hidden" name="',$data_keys[0];
				echo '" value="';
				echo $row[$data_keys[0]],'">';
				echo '<input type="submit" value="削除">';
				echo '</form>';
				echo '<br>';
			}

			echo '<form action="',$thisPage,'" method="post">';
			echo '<input type="hidden" name="command" value="insert">';
			echo '<input type="hidden" name="bill_id" ';
			echo 'value="',$bill['bill_id'],'">';
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
			showDataTable($table_titles,$sql_detail,$data_keys);
		}

		echo '<hr>';

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