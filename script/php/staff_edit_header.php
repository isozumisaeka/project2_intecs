
<?php
	$text_file='../texts/top_contents.text';

	$type_key=['news','sale','ranking'
	];

	$contents_keys = [
		'news'=>['date','title','content','order_number'],
		'sale'=>['image_pass','product_id','price','content','order_number'],
		'ranking'=>['image_pass','product_id','content','order_number']
	];

	if(file_exists($text_file)){
		$contents_array=json_decode(file_get_contents($text_file),true);

		if(is_array($contents_array)){
			foreach(array_keys($contents_array) as $type_key){
				if($type_key=='news'){
					$news_array=$contents_array[$type_key];
				}
				if($type_key=='sale'){
					$sale_array=$contents_array[$type_key];
				}
				if($type_key=='ranking'){
					$ranking_array=$contents_array[$type_key];
				}
			}
		}else{
			$contents_array=[];
		}
	}else{
		$contents_array=[];
	}
	
	if(!empty($_REQUEST['command'])){
		if($_REQUEST['command']=='delete'){
			if($_REQUEST['key_type']=='news'){
				unset($news_array[$_REQUEST['array_key']]);
				$news_array = array_values($news_array);
				$contents_array[$_REQUEST['key_type']]=$news_array;

			}else if($_REQUEST['key_type']=='sale'){
				unset($sale_array[$_REQUEST['array_key']]);
				$sale_array = array_values($sale_array);
				$contents_array[$_REQUEST['key_type']]=$sale_array;
			}else if($_REQUEST['key_type']=='ranking'){
				unset($ranking_array[$_REQUEST['array_key']]);
				$ranking_array = array_values($ranking_array);
				$contents_array[$_REQUEST['key_type']]=$ranking_array;
			}
		}
	}
	
	if(!empty($_REQUEST['type'])){
		switch ($_REQUEST['type']) {
			case 'news':
				if(empty($_REQUEST['date'])){
					echo '日付を入力してください。';
					echo '<hr>';
				}else if(empty($_REQUEST['title'])){
					echo 'タイトルを入力してください。';
					echo '<hr>';
				}else if(empty($_REQUEST['content'])){
					echo 'コンテンツを入力してください。';
					echo '<hr>';
				}else if(empty($_REQUEST['order_number'])){
					echo '表示順を入力してください。';
					echo '<hr>';
				}else{

					if(!empty($_REQUEST['command'])){
						if($_REQUEST['command'] == 'edit_update'){
							$news_array[$_REQUEST['order_number']] =[
								'date'=>$_REQUEST['date'],
								'title'=>$_REQUEST['title'],
								'content'=>$_REQUEST['content'],
								'order_number'=>$_REQUEST['order_number']
							];
							$contents_array[$_REQUEST['type']]=$news_array;

						}else{
							$news_array[$_REQUEST['order_number']] =[
								'date'=>$_REQUEST['date'],
								'title'=>$_REQUEST['title'],
								'content'=>$_REQUEST['content'],
								'order_number'=>$_REQUEST['order_number']
							];
							$contents_array[$_REQUEST['type']]=$news_array;
						}
					}else{
						$news_array[$_REQUEST['order_number']] =[
							'date'=>$_REQUEST['date'],
							'title'=>$_REQUEST['title'],
							'content'=>$_REQUEST['content'],
							'order_number'=>$_REQUEST['order_number']
						];
						$contents_array[$_REQUEST['type']]=$news_array;
					}
				}	
				break;
			
			case 'sale':
				if(empty($_REQUEST['image_pass'])){
					echo '画像ファイル名を入力してください。';
					echo '<hr>';
				}else if(empty($_REQUEST['product_id'])){
					echo '商品番号を入力してください。';
					echo '<hr>';
				}else if(empty($_REQUEST['price'])){
					echo '金額を入力してください。';
					echo '<hr>';
				}else if(empty($_REQUEST['content'])){
					echo 'コンテンツを入力してください。';
					echo '<hr>';
				}else if(empty($_REQUEST['order_number'])){
					echo '表示順を入力してください。';
					echo '<hr>';
				}else{
					
					if(!empty($_REQUEST['command'])){
						if($_REQUEST['command'] == 'edit_update'){
							$sale_array[$_REQUEST['order_number']] =[
							'image_pass'=>$_REQUEST['image_pass'],
							'product_id'=>$_REQUEST['product_id'],
							'price'=>$_REQUEST['price'],
							'content'=>$_REQUEST['content'],
							'order_number'=>$_REQUEST['order_number']
							];
							$contents_array[$_REQUEST['type']]=$sale_array;

						}else{
							$sale_array['order_number'] =[
							'image_pass'=>$_REQUEST['image_pass'],
							'product_id'=>$_REQUEST['product_id'],
							'price'=>$_REQUEST['price'],
							'content'=>$_REQUEST['content'],
							'order_number'=>$_REQUEST['order_number']
							];
							$contents_array[$_REQUEST['type']]=$sale_array;
						}
					}else{
						$sale_array['order_number'] =[
						'image_pass'=>$_REQUEST['image_pass'],
						'product_id'=>$_REQUEST['product_id'],
						'price'=>$_REQUEST['price'],
						'content'=>$_REQUEST['content'],
						'order_number'=>$_REQUEST['order_number']
						];
						$contents_array[$_REQUEST['type']]=$sale_array;
					}
				}
				break;

			case 'ranking':
				if(empty($_REQUEST['image_pass'])){
					echo '画像ファイル名を入力してください。';
					echo '<hr>';
				}else if(empty($_REQUEST['product_id'])){
					echo '商品番号を入力してください。';
					echo '商品番号を入力してください。';
				}else if(empty($_REQUEST['content'])){
					echo '商品番号を入力してください。';
					echo 'コンテンツを入力してください。';
				}else if(empty($_REQUEST['order_number'])){
					echo '商品番号を入力してください。';
					echo '表示順を入力してください。';
				}else{
					if(!empty($_REQUEST['command'])){
						if($_REQUEST['command'] == 'edit_update'){
							$ranking_array[$_REQUEST['order_number']] =[
								'image_pass'=>$_REQUEST['image_pass'],
								'product_id'=>$_REQUEST['product_id'],
								'content'=>$_REQUEST['content'],
								'order_number'=>$_REQUEST['order_number']
							];
							$contents_array[$_REQUEST['type']]=$ranking_array;

						}else{
							$ranking_array['order_number'] =[
								'image_pass'=>$_REQUEST['image_pass'],
								'product_id'=>$_REQUEST['product_id'],
								'content'=>$_REQUEST['content'],
								'order_number'=>$_REQUEST['order_number']
							];
							$contents_array[$_REQUEST['type']]=$ranking_array;
						}
					}else{
						$ranking_array['order_number'] =[
							'image_pass'=>$_REQUEST['image_pass'],
							'product_id'=>$_REQUEST['product_id'],
							'content'=>$_REQUEST['content'],
							'order_number'=>$_REQUEST['order_number']
						];
						$contents_array[$_REQUEST['type']]=$ranking_array;
					}
				}
				break;
			default:
				// code...
				break;
		}
	}

	$news_topic_array=[
		['staff_news.php','ニュース'],
		['staff_sale.php','セール'],
		['staff_ranking.php','ランキング']
	];

	foreach($news_topic_array as $news){		
	createLink($news);
	echo '&nbsp;';
	}

?>