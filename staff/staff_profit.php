<?php session_start();?>
<?php $title = '売上管理画面';?>
<?php require '../script/php/our_functions.php';?>
<?php require '../script/php/staff_header.php';?>
<?php
if(isset($_SESSION['staff'])){
	function showTotalProfit($_initial,$_final){
		$pdo= new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
		if(!(empty($_initial) or empty($_final))){
			$sql=$pdo->prepare('select 
				
				sum(purchase_number),
				sum(product.price*purchase_number)
				from bill
			 	left join bill_detail on bill.bill_id=bill_detail.bill_id
			 	left join product on bill_detail.product_id=product.product_id 
			 	where purchase_date >= ? and purchase_date <= ?
			 ');
			$sql->execute([$_initial,$_final]);
		}else{
			$sql=$pdo->prepare('select 
				
				sum(purchase_number),
				sum(product.price*purchase_number)
				from bill
			 	left join bill_detail on bill.bill_id=bill_detail.bill_id
			 	left join product on bill_detail.product_id=product.product_id 
			 ');
			$sql->execute([]);
		}
		showDataTable(['販売数','合計売上'],$sql,['sum(purchase_number)',
				'sum(product.price*purchase_number)']);
	}

	$table_titles=[
		'商品番号',
		'商品名',
		'商品単価',
		'販売数',
		'商品合計売上'
	];

	$data_keys=[
		'product_id',
		'product_name',
		'price',
		'sum(purchase_number)',
		'sum(product.price*purchase_number)'
	];

	$isEditable=[
		'product_id'=>false,
		'product_name'=>false,
		'price'=>false,
		'sum(purchase_number)'=>false,
		'sum(product.price*purchase_number)'=>false

	];
	$pdo= new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
	echo '<h2>',$title,'</h2>';
	echo '<hr>';

	if(isset($_REQUEST['command'])){
		if(preg_match('/^[0-9]{4}$/', $_REQUEST['initial_year'])
			and preg_match('/^([0]{1}[1-9]{1}|[1]{1}[0-2]{1})$/', $_REQUEST['initial_month'])
			and preg_match('/^([0]{1}[1-9]{1}|[1-2]{1}[0-9]{1}|[3]{1}[0-3]{1})$/', $_REQUEST['initial_date'])
			and preg_match('/^[0-9]{4}$/', $_REQUEST['final_year'])
			and preg_match('/^([0]{1}[1-9]{1}|[1]{1}[0-2]{1})$/', $_REQUEST['final_month'])
			and preg_match('/^([0]{1}[1-9]{1}|[1-2]{1}[0-9]{1}|[3]{1}[0-3]{1})$/', $_REQUEST['initial_date'])){

			$initial = $_REQUEST['initial_year'].'-'.$_REQUEST['initial_month'].'-'.$_REQUEST['initial_date'];
			$final = $_REQUEST['final_year'].'-'.$_REQUEST['final_month'].'-'.$_REQUEST['final_date'];

			$sql=$pdo->prepare('select 
				
				product.product_id,
				product.product_name,
				price,
				sum(purchase_number),
				sum(product.price*purchase_number)
				from bill
			 	left join bill_detail on bill.bill_id=bill_detail.bill_id
			 	left join product on bill_detail.product_id=product.product_id 
			 	where purchase_date >= ? and purchase_date <= ?
			 	group by product_id
			 	order by sum(purchase_number) desc
			 ');
			$sql->execute([$initial,$final]);
		}else{
			echo '日付を二桁で入力してください。';
			$initial = null;
			$final = null;
			$sql=$pdo->prepare('select 
			product.product_id,
			product.product_name,
			price,
			sum(purchase_number),
			sum(product.price*purchase_number)
			from bill
		 	left join bill_detail on bill.bill_id=bill_detail.bill_id
		 	left join product on bill_detail.product_id=product.product_id 
		 	group by product_id  
			 order by sum(purchase_number) desc
			 ');
			$sql->execute([]);
		}
	}else{
		$initial = null;
		$final = null;
		$sql=$pdo->prepare('select 
			product.product_id,
			product.product_name,
			price,
			sum(purchase_number),
			sum(product.price*purchase_number)
			from bill
		 	left join bill_detail on bill.bill_id=bill_detail.bill_id
		 	left join product on bill_detail.product_id=product.product_id 
		 	group by product_id  
			order by sum(purchase_number) desc
		 ');
		$sql->execute([]);
	}

	echo '<h3>期間</h3>';
	echo '<form action="staff_profit.php" method="post">';
	echo '<input type="hidden" name="command" value="search">';
	if(isset($_REQUEST['command'])){
		if(preg_match('/^[0-9]{4}$/', $_REQUEST['initial_year'])
			and preg_match('/^([0]{1}[1-9]{1}|[1]{1}[0-2]{1})$/', $_REQUEST['initial_month'])
			and preg_match('/^([0]{1}[1-9]{1}|[1-2]{1}[0-9]{1}|[3]{1}[0-3]{1})$/', $_REQUEST['initial_date'])
			and preg_match('/^[0-9]{4}$/', $_REQUEST['final_year'])
			and preg_match('/^([0]{1}[1-9]{1}|[1]{1}[0-2]{1})$/', $_REQUEST['final_month'])
			and preg_match('/^([0]{1}[1-9]{1}|[1-2]{1}[0-9]{1}|[3]{1}[0-3]{1})$/', $_REQUEST['initial_date'])){

			echo '<input type="text" name="initial_year" value="',$_REQUEST['initial_year'],'">';
			echo '年';
			echo '<input type="text" name="initial_month" value="',$_REQUEST['initial_month'],'">';
			echo '月';
			echo '<input type="text" name="initial_date" value="',$_REQUEST['initial_date'],'">';
			echo '日';

			echo '<br>';
			echo '~';

			echo '<input type="text" name="final_year" value="',$_REQUEST['final_year'],'">';
			echo '年';
			echo '<input type="text" name="final_month" value="',$_REQUEST['final_month'],'">';
			echo '月';
			echo '<input type="text" name="final_date" value="',$_REQUEST['final_date'],'">';
			echo '日';
		}else{
			echo '<input type="text" name="initial_year">';
			echo '年';
			echo '<input type="text" name="initial_month">';
			echo '月';
			echo '<input type="text" name="initial_date">';
			echo '日';

			echo '<br>';
			echo '~';

			echo '<input type="text" name="final_year">';
			echo '年';
			echo '<input type="text" name="final_month">';
			echo '月';
			echo '<input type="text" name="final_date">';
			echo '日';
		}
	}else{
		echo '<input type="text" name="initial_year">';
		echo '年';
		echo '<input type="text" name="initial_month">';
		echo '月';
		echo '<input type="text" name="initial_date">';
		echo '日';

		echo '<br>';
		echo '~';

		echo '<input type="text" name="final_year">';
		echo '年';
		echo '<input type="text" name="final_month">';
		echo '月';
		echo '<input type="text" name="final_date">';
		echo '日';
	}

	echo '<input type="submit" value="検索">';
	echo '</form>';
	echo '<hr>';


	showTotalProfit($initial,$final);
	showDataTable($table_titles,$sql,$data_keys);
	
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