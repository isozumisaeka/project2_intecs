<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="../script/css/slick.css" />
	<link rel="stylesheet" type="text/css" href="../script/css/slick-theme.css" />
	<link rel="stylesheet" type="text/css" href="../script/css/style_isozumi.css">
	<link rel="stylesheet" type="text/css" href="../script/css/style_t.css">
	<!-- <link rel="stylesheet" type="text/css" href="../script/css/style_tachi.css"> -->

</head>

<body>
	<header>
		<nav class="navbar">
			<div class="nav_left">
				<h2><a href="index.php">h i n n a</a></h2>
			</div>
			<div class="nav_right">
				<p><a href="shop_cart.php" title=""><img src="../images/icon_images/cart.png" class="cart"></a></p>
				<form action="product_list.php" method="post">
					<p>search:<input type="text" name="keyword">
						<input type="submit" value="検索" class="button">
					</p>
				</form>
				<p><a href="mypage.php" title="">mypage</a></p>
				<p><a href="login.php" title="">login/logout</a></p>

				<p><a href="create_new_account.php" title="">signup</a></p>

			</div>
		</nav>
		<img src="../images/header_top.jpg" alt="" class="header_image">
		<div class='menu_bar'>
			<p><a href="about.php">ABOUT US</a></p>
			<p><a href="product_list.php">PRODUCTS</a></p>
			<p><a href="faq.php">FAQ</a></p>
			<p><a href="contact.php">CONTACT</a></p>
		</div>
	</header>
	<!-- /header -->