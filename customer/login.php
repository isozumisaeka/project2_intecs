<?php $title = 'login | hinna'; ?>
<?php require '../script/php/header.php'; ?>
<main>
	<h1>Login</h1>
	<!-- class追加 -->
	<div class="login_table">
		<form action="login_check.php" method="post">
			<table>
				<tr>
					<th>ログインID</th>
					<td><input type="text" name="login" value=""></td>
				</tr>
				<tr>
					<th>パスワード</th>
					<td><input type="password" name="password" value=""></td>
				</tr>
			</table>
			<p class="send"><input type="submit" value="ログイン" class="button"></p>
		</form>
		<form action="logout.php" method="post">
			<p class="send"><input type="submit" name="" value="ログアウト" class="button"></p>
		</form>
		<p>or</p>
		<p>まだ登録されていませんか？</p>
		<form action="create_new_account.php" method="post">
			<p class="send"><input type="submit" name="" value="新規登録" class="button"></p>
			<!-- class追加 -->
		</form>
	</div>


</main>
<?php require '../script/php/footer.php'; ?>