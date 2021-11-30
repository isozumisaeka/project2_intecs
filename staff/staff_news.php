<?php session_start();?>
<?php $title = 'ニュース管理画面'; $thisPage='staff_news.php'?>
<?php require '../script/php/our_functions.php';?>
<?php require '../script/php/staff_header.php';?>
<?php
if(isset($_SESSION['staff'])){
	require '../script/php/staff_edit_header.php';

	if(!empty($_REQUEST['command'])){
		if($_REQUEST['command']=='edit'){
			$key = $_REQUEST['array_key'];
			$contents=$news_array[$key];

			echo '<form action="',$thisPage,'" method="post">';

			echo '<input type="hidden" name="command" value="edit_update">';
			echo '<input type="hidden" name="type" value="news">';
			echo '日付<input type="text" name="date" value="'
			,$contents['date'],'">';
			echo 'タイトル<input type="text" name="title" value="'
			,$contents['title'],'">';
			echo '表示順<input type="text" name="order_number" value="'
			,$key,'">';

			echo '<br>';

			echo '本文<br><textarea rows="10" cols="60" name="content">'
			,$contents['content'],'</textarea>';

			echo '<br>';
			echo '<input type="submit" value="更新">';
			echo '</form>';
		}else{
		
			echo '<form>';

			echo '<input type="hidden" name="type" value="news">';
			echo '日付<input type="text" name="date">';
			echo 'タイトル<input type="text" name="title">';
			echo '表示順<input type="text" name="order_number" value="';
			echo count($news_array);
			echo '">';


			echo '<br>';

			echo '本文<br><textarea rows="10" cols="60" name="content"></textarea>';

			echo '<br>';
			echo '<input type="submit" value="投稿">';
			echo '</form>';
		}
	}else{
		
		echo '<form>';

		echo '<input type="hidden" name="type" value="news">';
		echo '日付<input type="text" name="date">';
		echo 'タイトル<input type="text" name="title">';
		echo '表示順<input type="text" name="order_number" value="';
		echo count($news_array);
		echo '">';

		echo '<br>';

		echo '本文<br><textarea rows="10" cols="60" name="content"></textarea>';

		echo '<br>';
		echo '<input type="submit" value="投稿">';
		echo '</form>';
	}

	echo '<hr>';
	require '../script/php/staff_edit_footer.php';

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