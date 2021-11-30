<?php $title = 'HOME｜hinna'; ?>
<?php require '../script/php/header.php'; ?>
<!-- トップページのスライド -->
<div class="sliders">
	<div><img src="../images/top_images/1.jpg"></div>
	<div><img src="../images/top_images/2.jpg"></div>
	<div><img src="../images/top_images/3.jpg"></div>
	<div><img src="../images/top_images/4.jpg"></div>
	<div><img src="../images/top_images/5.jpg"></div>
	<div><img src="../images/top_images/6.jpg"></div>
	<div><img src="../images/top_images/7.jpg"></div>
	<div><img src="../images/top_images/8.jpg"></div>
	<div><img src="../images/top_images/9.jpg"></div>
</div>

<!-- コンセプト -->
<div class="concept">
	<h1>CONCEPT</h1>
	<h2 style="text-align:center">北欧<br>×<br>おうち暮らし</h2>
	<p>こんな時代だからこそ温もりのある「ていねいな暮らし」を取り入れませんか？<br>わたし達は日常生活に溶け込める北欧スタイルのさまざまな商品をご用意しております。<br>おうち時間が増えた今こそ、最高のおうち時間を過ごしていただけるお手伝いをしたい。<br>そんな気こちを込めてショップをオープンしました。</p>
</div>

<!-- ジャンル検索 -->
<h1>PRODUCTS</h1>
<div class="genre_link">
	<div class="one_calum">
		<a href="product_list.php?search_category=家具"><img src="../images/genre_images/furniture1.jpg" alt="家具"></a>

	</div>
	<div class="one_calum">
		<a href="product_list.php?search_category=雑貨"><img src="../images/genre_images/zakka1.jpg" alt="雑貨"></a>
	</div>
	<div class="one_calum">
		<a href="product_list.php?search_category=食品"><img src="../images/genre_images/food1.jpg" alt="食品"></a>
	</div>
	<div class="one_calum">
		<a href="product_list.php?search_category=食器"><img src="../images/genre_images/shokki1.jpg" alt="食器"></a>
	</div>
</div>
<!-- ニュース　JSONファイルと連携させます -->
<div class="news">
	<h1>NEWS</h1>
	<?php
	$news = '../texts/top_contents.text';
	if (file_exists($news)) {
		$board = json_decode(file_get_contents($news), true);
	}
	// $board[] = $_REQUEST['news'];
	// file_put_contents($news, json_encode($board));
	$newsArray = $board['news'];
	echo '<table class="news_table">';
	foreach ($newsArray as $newsList) {
		echo '<tr>';
		echo '<th>' . $newsList['date'] . '</th>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="news_td">◆' . $newsList['title'] . '◆</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>' . $newsList['content'] . '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<th></th><td></td>';
		echo '</tr>';
		// echo '<tr>';
		// echo '<th rowspan="2">' . $newsList['date'] . '</th>';
		// echo '<td class="news_td">◆' . $newsList['title'] . '◆</td>';
		// echo '</tr>';
		// echo '<tr>';
		// echo '<td>' . $newsList['content'] . '</td>';
		// echo '</tr>';
		// echo '<tr>';
		// echo '<th></th><td></td>';
		// echo '</tr>';
	}
	echo '</table>';
	?>
</div>

<!-- ランキング一覧 -->
<h1>BEST SELLER in AUGUST</h1>
<div class="rank">
	<?php
	$pdo = new PDO('mysql:host=localhost;dbname=store;charset=utf8', 'staff', 'password');

	$ranking = '../texts/top_contents.text';
	if (file_exists($ranking)) {
		$board = json_decode(file_get_contents($ranking), true);
	}
	$rankingArray = $board['ranking'];
	foreach ($rankingArray as $rankingList) {
		$sql = $pdo->prepare('select product_name from product
			where product_id = ? ');
		$sql->execute([$rankingList['product_id']]);
		foreach ($sql as $row) {
			$product_name = $row['product_name'];
		}
		// echo '<div class="rank">';
		echo '<div class="ranking"><p><a href="product_detail.php?product_id=';
		echo $rankingList['product_id'];
		echo '"><img src="../images/ranking_images/';
		echo $rankingList['image_pass'];
		echo '">';
		echo '</a></p>';
		// echo '<div class="ranking_name">';
		echo '<p>' . $product_name . '</p>';
		// echo '</div>';
		echo '</div>';
	}
	?>
</div>
</div>

<!-- セール情報一覧 -->
<div class="sale">
	<h1>SALE</h1>
	<div class="ranking_slide"><?php
								$pdo = new PDO('mysql:host=localhost;dbname=store;charset=utf8', 'staff', 'password');

								$sale = '../texts/top_contents.text';
								if (file_exists($sale)) {
									$board = json_decode(file_get_contents($sale), true);
								}
								$saleArray = $board['sale'];
								foreach ($saleArray as $saleList) {
									echo '<div><a href="product_detail.php?product_id=';
									echo $saleList['product_id'];
									echo '"><img src="../images/ranking_images/';
									echo $saleList['image_pass'];
									echo '">';
									$sql = $pdo->prepare('select product_name from product
			where product_id = ? ');
									$sql->execute([$saleList['product_id']]);
									foreach ($sql as $row) {
										$product_name = $row['product_name'];
									}
									echo $product_name;
									echo '</a></div>';
								}
								?>
	</div>
</div>

<?php require '../script/php/footer.php'; ?>