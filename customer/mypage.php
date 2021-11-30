<?php $title = 'mypage | hinna';?>
<?php session_start();?>
<?php require '../script/php/header.php'; ?>
	<main>
		<h1>User Information</h1>
		<div class="login_table">
		<?php
			$name=$address=$mail=$tel=$login=$password='';
			if (isset($_SESSION['customer'])) {
				$id=$_SESSION['customer']['customer_id'];
				$name=$_SESSION['customer']['customer_name'];
				$address=$_SESSION['customer']['customer_address'];
				$mail=$_SESSION['customer']['e_mail_address'];
				$tel=$_SESSION['customer']['tel_number'];
				$login=$_SESSION['customer']['login'];
				$password=$_SESSION['customer']['password'];
			}
			echo '<table>';
			echo '<tr><th>お名前：</th>';
			echo '<td>', $name, '</td></tr>';
			echo '<tr><th>ご住所：</th>';
			echo  '<td>', $address, '</td></tr>';
			echo '<tr><th>電話番号：</th>';
			echo '<td>', $tel, '</td></tr>';
			echo '<tr><th>メールアドレス：</th>';
			echo '<td>', $mail, '</td></tr>';
			echo '<tr><th>ログイン名：</th>';
			echo '<td>', $login, '</td></tr>';
			echo '<tr><th>パスワード：</t>';
			echo '<td>', $password, '</td></tr>';
			echo '</table>';
		?>

		<table>
			<tr>
				<th>
					<form action="my_favorite.php" method="post" >
						<input type="submit" name="" value="お気に入り" class="button">
					</form>
				</th>
				<th>
					<?php
					echo '<form action="purchase_history.php" method="post" >';
					echo '<input type="hidden" name="customer_id" value="',$id,'">';
					echo '<input type="submit" name="" value="購入履歴" class="button">';
					echo '</form>';
					?>
				</th>
				<th>
					<form action="update_delete.php" method="post" >
						<input type="submit" name="" value="登録情報修正" class="button">
					</form>
				</th>
			</tr>
		</table>
		</div>
	</main>
<?php require '../script/php/footer.php'; ?>