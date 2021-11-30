	<?php session_start();?>
<?php $title = 'purchase_cancel | hinna';?>
<?php require '../script/php/header.php'; ?>
<main>
	<?php
		$pdo=new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');

		if(isset($_SESSION['customer'])){
			date_default_timezone_set('Japan');
			$contact_date=date('Y-m-d');
			$contact_customer_type=$_REQUEST['contact_customer_type'];
			$contact_customer_name=$_REQUEST['contact_customer_name'];
			$contact_customer_mail=$_REQUEST['contact_customer_mail'];
			$support_status=$_REQUEST['support_status'];
			$contact_title=$_REQUEST['contact_title'];
			$contact_contents=$_REQUEST['contact_contents'];

			$sql=$pdo->prepare('insert into contact value(null,?,?,?,?,?,?,?)');
			$sql->execute([$contact_date,
				$contact_customer_type,$contact_customer_name,			
				$contact_customer_mail,$support_status,
				$contact_title,$contact_contents
			]);

			$sql=$pdo->prepare('update bill_detail set delivery_status=? where bill_id=?');
			$sql->execute(['キャンセル対応中',$_REQUEST['bill_id']
			]);
			echo '<h1>Your Request has sent!</h1>';
			echo '<p>キャンセルを送信しました。</p>';
		}else{
			echo '<h1>Error!</h1>';
			echo '<p>ログインしてください。<p>';
		}
	?>


<h3>まだ、キャンセルは確定しておりません</h3>
<p>ご連絡いただきましたご注文の状況をスタッフが確認いたします。<br>
	状況確認の上、E-mailにてご連絡させていただきます。<br>
	いましばらくお待ちください。
</p>
<p>
	※お問い合わせに順番に対応しておりますので、お返事に数日いただく場合がございます。<br>
	※お問い合わせをいただいてから、５営業日（平日のみ営業）を過ぎても連絡がない場合<br>
	　お手数ではございますが、お問い合わせをお願いいたします。
</p>
		<form action="mypage.php" method="post" class="send">
			<input type="submit" name="" value="マイページへ戻る" class="button">
		</form>
		

</main>
<?php require '../script/php/footer.php'; ?>