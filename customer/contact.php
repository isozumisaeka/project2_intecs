<?php session_start(); ?>
<?php $title = 'CONTACT | hinna'; ?>
<?php require '../script/php/header.php'; ?>
<!-- メイン -->
<main>
	<h1>Contact</h1>
	<p>下記より内容を入力のうえお問い合わせください。<br>受付時間は24時間となります。<br>3営業日以内にメールにて返信を差し上げます。<br>
		万が一返信の確認できない場合は、お手数ですがお電話にて直接店舗へお知らせください。<br>（03-1234-5678／火曜日を除く10:30〜20:45）</p>
	<div class="contact_contents">
		<?php
		if (isset($_SESSION['customer'])) {
			$contact_customer_type = $_SESSION['customer']['customer_id'];
		} else {
			$contact_customer_type = 'guest';
		}
		echo '<form action="check_contact.php" method="post">';
		echo '<input type="hidden" name="contact_customer_type" value="', $contact_customer_type, '">';
		echo '<input type="hidden" name="support_status" value="未対応">';
		?>

		<table>
			<tr>
				<th>name</th>
				<td><input type="text" name="name" value=""></td>
			</tr>

			<tr>
				<th>email</th>
				<td><input type="text" name="email" value=""></td>
			</tr>

			<tr>
				<th>お問い合わせタイトル</th>
				<td><select name="contact_title">
						<option value="商品について">商品について</option>
						<option value="その他お問い合わせ">その他のお問い合わせ</option>
					</select></td>
			</tr>

			<tr>
				<th>お問い合わせ内容</th>
				<td><textarea name="contact_contents"></textarea></td>
			</tr>
		</table>
		<div class="send">
			<input type="submit" value="送信" class="button">
		</div>
		</form>
	</div>
</main>
<!-- メイン ここまで-->
<?php require '../script/php/footer.php'; ?>