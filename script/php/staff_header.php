<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $title;?></title>
<link rel="stylesheet" href="../script/css/staff.css">
<!--link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="style.css"-->
</head>
<body>
	<header>
		<h1><?php echo $title; ?></h1>
		<?php 
		$homeLink = ['staff_index.php','ホーム'];
		createLink($homeLink); 
		?>
		<a href="staff_login.php">ログアウト</a>
		<hr>
	</header>
