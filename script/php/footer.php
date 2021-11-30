<footer>
	<div class="footer_top">
		<div class="footer_left">
			<p><a href="about.php">ABOUT US</a></p>
			<p><a href="product_list.php">PRODUCTS</a></p>
			<p><a href="faq.php">FAQ</a></p>
			<p><a href="contact.php">CONTACT</a></p>
		</div>
		<div class="footer_middle">
			<h2><a href="index.php">hinna</a></h2>
			<p>03-1234-5678</p>
			<p>OPEN 10:00~21:00</p>
			<p>CLOSE Tuesdays</p>
		</div>
		<div class="footer_right">
			<p><a href="https://www.facebook.com/"><img src="../images/icon_images/facebook.png" class="sns"></a></p>
			<p><a href="https://www.instagram.com/"><img src="../images/icon_images/instagram.png" class="sns"></a></p>
			<p><a href="https://www.twitter.com/"><img src="../images/icon_images/twitter.png" class="sns"></a></p>
		</div>
	</div>
	<div class="footer_bottom">
		<p>Copyright© hinna / All rights reserved.</p>
	</div>
</footer>
<!-- <script type="text/javascript" src="slick/slick.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>
<script type="text/javascript" src="../script/js/slick.js"></script>
<script>
	$('.sliders').slick({
		dots: true,
		infinite: true,
		speed: 800,
		fade: false,
		cssEase: 'linear',
		autoplay: true,
		autoplaySpeed: 3000
	});

	$('.ranking_slide').slick({
		dots: true, // ドットインジケーターの表示
		infinite: true, // スライドのループを有効にするか
		slidesToShow: 5, // 表示するスライド数を設定
		slidesToScroll: 3, // スクロールするスライド数を設定
		autoplay: true,
		autoplaySpeed: 3000
	});
</script>
</body>

</html>