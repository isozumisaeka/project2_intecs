<?php session_start();?>
<?php $title = 'purchase_history | hinna';?>
<?php require '../script/php/header.php'; ?>
<main>
	<h1>Purchase History</h1>
<div class="product_table">
<table>
	<tr><th>日付</th><th>購入商品</th><th>購入品目数</th><th>合計金額</th></tr>

<?php
	$pdo=new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
	if(isset($_SESSION['customer'])){
		$sql=$pdo->prepare('select 
			bill.bill_id,purchase_date,product_name,
			count(bill_detail.product_id),sum(price*purchase_number) from bill 
			left join bill_detail on bill.bill_id = bill_detail.bill_id
			left join product on bill_detail.product_id = product.product_id
			where customer_id = ? group by bill.bill_id');
		$sql->execute([$_SESSION['customer']['customer_id']]);
		$sql_bill=$sql;
		foreach($sql as $row){
			echo '<form action="purchase_detail.php" method="post" >';
			echo '<input type="hidden" name="bill_id" value="',$row['bill_id'],'" >';
			echo '<tr><td>',$row['purchase_date'],'</td>';
			echo '<td>',$row['product_name'],'等</td>';
			echo '<td>',$row['count(bill_detail.product_id)'],'</td>';
			echo '<td>',number_format($row['sum(price*purchase_number)']),'</td>';
			echo '<td><input type="submit" name="" value="詳細" class="button"><input type="submit" name="" value="キャンセル" class="button"></td>';
			echo '</tr>';
			// echo '<input type="submit" name="" value="詳細" class="button">';
			// echo '<input type="submit" name="" value="キャンセル" class="button">';
			echo '</form>';
			echo "\n";
		}
	}else{
		echo '<h1>Error!</h1>';
		echo '<p>ログインしてください。<p>';
	}
	echo '</table>';
?>

	
		<form action="mypage.php" method="post" class="send">
			<input type="submit" name="" value="戻る" class="button">
		</form>
		
</div>
</main>
<?php require '../script/php/footer.php'; ?>