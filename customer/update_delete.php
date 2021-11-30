<?php session_start();?>
<?php $title = 'update_delete | hinna';?>
<?php require '../script/php/header.php'; ?>
<main>
		<h1>Account Update/Delete</h1>
		<h3 style="text-decoration:underline;">登録内容の更新</h3>
		<p>更新されたい内容を変更いただき、下記更新ボタンをクリックしてください。</p>
		<h3 style="text-decoration:underline;">アカウント削除</h3>
		<p>下記削除ボタンをクリックしてください。<br>
			注）一度クリックされますと、アカウントが削除され、<br><strong>元には戻ることができなくなります</strong>のでご注意ください。
		</p>
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
			echo '<form action="check_update.php" method="post">';
			echo '<table>';
			echo '<tr><th>お名前</th><td>';
			echo '<input type="text" name="name" value="', $name, '">';
			echo '</td></tr>';
			echo '<tr><th>ご住所</th><td>';
			echo '<input type="text" name="address" value="', $address, '">';
			echo '</td></tr>';
			echo '<tr><th>電話番号</th><td>';
			echo '<input type="text" name="tel" value="', $tel, '">';
			echo '</td></tr>';
			echo '<tr><th>メールアドレス</th><td>';
			echo '<input type="text" name="mail" value="', $mail, '">';
			echo '</td></tr>';
			echo '<tr><th>ログイン名</th><td>';
			echo '<input type="text" name="login" value="', $login, '">';
			echo '</td></tr>';
			echo '<tr><th>パスワード</th><td>';
			echo '<input type="text" name="password" value="', $password, '">';
			echo '</td></tr>';
			echo '</table>';
			echo '<div class="send" style="margin-bottom:10px">';
			echo '<input type="submit" value="更新" class="button">';
			echo '</div>';
			echo '</form>';
		?>
		<?php
		echo '<form action="check_delete.php" name="" method="post" >';
		echo '<input type="hidden" name="customer_id" value="',$id,'">';
		echo '<div class="send">';
		echo '<input type="submit" name="" value="削除" class="button">';
		echo '</div>';
		echo '</form>';
		?>
	</div>
</main>
<?php require '../script/php/footer.php'; ?>