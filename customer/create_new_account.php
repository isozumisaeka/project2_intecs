<?php session_start();?>
<?php $title = 'create_new_account | hinna';?>
<?php require '../script/php/header.php'; ?>
<main>
	<h1>Sign Up</h1>
	<p>※電話番号はハイフン不要です。</p>
	<p>※パスワードは半角英数字８文字以上で、<br>半角英数字・全角角英字を各１文字以上を含んでください。</p>
<div class="login_table">
<?php
$name=$address=$mail=$tel=$login=$password='';
if(isset($_SESSION['customer'])){
	$name=$_SESSION['customer']['customer_name'];
	$address=$_SESSION['customer']['customer_address'];
	$mail=$_SESSION['customer']['e_mail_address'];
	$tel=$_SESSION['customer']['tel_number'];
	$login=$_SESSION['customer']['login'];
	$password=$_SESSION['customer']['password'];
}
echo '<form action="check_new_account.php" method="post" >';
echo '<input type="hidden" name="available" value="1" >';
echo '<table>';
echo '<tr><th>お名前</th0><td>';
echo '<input type="text" name="name" value="',$name,'">';
echo '</td></tr>';
echo '<tr><th>メールアドレス</th><td>';
echo '<input type="text" name="mail" value="',$mail,'">';
echo '</td></tr>';
echo '<tr><th>電話番号</th><td>';
echo '<input type="text" name="tel" value="',$tel,'">';
echo '</td></tr>';
echo '<tr><th>ご住所</th><td>';
echo '<input type="text" name="address" value="',$address,'">';
echo '</td></tr>';
echo '<tr><th>ログイン名</th><td>';
echo '<input type="text" name="login" value="',$login,'">';
echo '</td></tr>';
echo '<tr><th>パスワード</th><td>';
echo '<input type="password" name="password" value="',$password,'">';
echo '</td></tr>';
echo '</table>';
echo '<div class="send">';
echo '<input type="submit" value="新規登録" class="button">';
echo '</div>';
echo '</form>';
?>
</div>
</main>
<?php require '../script/php/footer.php'; ?>