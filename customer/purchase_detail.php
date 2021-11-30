<?php session_start(); ?>
<?php $title = 'purchase_detail | hinna'; ?>
<?php require '../script/php/header.php'; ?>
<main>
	<h1>Purchased Detail</h1>
	<div class="favorite_table">
		<table>

			<?php
			if (isset($_REQUEST['bill_id'])) {

				$pdo = new PDO('mysql:host=localhost;dbname=store;charset=utf8', 'staff', 'password');
				$sql = $pdo->prepare('select bill_id,purchase_date from bill
			where bill_id = ? ');
				$sql->execute([$_REQUEST['bill_id']]);
				$sql_bill = $sql;
				foreach ($sql_bill as $row1) {
					echo '<tr><th>伝票No</th><td>', $row1['bill_id'], '</td>';
					echo '<th>購入日</th><td>', $row1['purchase_date'], '</td></tr>';
				}

				$sql = $pdo->prepare('select 
			product_name,price,purchase_number,price*purchase_number,delivery_status 
			from bill_detail left join product 
			on bill_detail.product_id = product.product_id
			where bill_id = ? ');
				$sql->execute([$_REQUEST['bill_id']]);
				$sql_detail = $sql;
				foreach ($sql_detail as $row2) {
					echo '<tr><th>購入商品</th><th>価格</th><th>購入数</th><th>小計</th><th>発送状況</th></tr>';
					echo '<tr><td>', $row2['product_name'], '</td>';
					echo '<td>', $row2['price'], '</td>';
					echo '<td>', $row2['purchase_number'], '</td>';
					echo '<td>', $row2['price*purchase_number'], '</td>';
					echo '<td>', $row2['delivery_status'], '</td></tr>';
				}

				$sql = $pdo->prepare('select sum(price*purchase_number) 
			from bill_detail 
			left join product on bill_detail.product_id = product.product_id
			where bill_id = ? ');
				$sql->execute([$_REQUEST['bill_id']]);
				$sql_sum = $sql;
				foreach ($sql_sum as $row3) {
					echo '<tr><td></td><td></td><th>合計</th><td>', $row3['sum(price*purchase_number)'], '</td></tr>';
					echo "\n";
				}

				echo '</table>';
				echo '</div>';

				echo '<form action="purchase_cancel.php" method="post" class="send">';
				echo '<input type="hidden" name="contact_customer_type" ;
				value="', $_SESSION['customer']['customer_id'], '">';
				echo '<input type="hidden" name="contact_customer_name" 
				value="', $_SESSION['customer']['customer_name'], '">';
				echo '<input type="hidden" name="contact_customer_mail" 
				value="', $_SESSION['customer']['e_mail_address'], '">';
				echo '<input type="hidden" name="support_status" value="未対応">';
				echo '<input type="hidden" name="contact_title" value="注文キャンセル">';
				echo '<input type="hidden" name="contact_contents" 
				value="伝票番号', $_REQUEST['bill_id'], 'の注文をキャンセルしたい。">';
				echo '<input type="hidden" name="bill_id" 
				value="', $_REQUEST['bill_id'], '">';
				echo '<input type="submit" value="この注文をキャンセルする" class="button">';
				echo '</form>';


				echo '<form action="purchase_history.php" method="post" class="send">';
				echo '<input type="submit" name="" value="戻る" class="button">';
				echo '</form>';
			} else {
				echo '<h1>Error!</h1>';
				echo '<p>不明の商品です。</p>';
				echo '<a href="index.php" class="button">TOPへ</a>';
			}

			?>
</main>
<?php require '../script/php/footer.php'; ?>