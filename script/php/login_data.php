<?php
	unset($_SESSION['customer']);
	$pdo=new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
	$sql=$pdo->prepare('select * from customer where login=? and password=?'); 
	$sql->execute([$_REQUEST['login'],$_REQUEST['password']]);
	foreach ($sql as $row){
	$_SESSION['customer']=[
		'customer_id'=>$row['customer_id'],'customer_name'=>$row['customer_name'],
		'customer_address'=>$row['customer_address'],'login'=>$row['login'],
		'password'=>$row['password']];
	}
	if(isset($_SESSION['customer'])){
		echo '<p>ようこそ、',$_SESSION['customer']['customer_name'],'さん</P>';
		}else{
			echo 'ログイン名またはパスワードが違います。';
			echo '<form action="login.php" method="post" >
			<input type="submit" value="ログイン画面へ">';
		}
?>