<?php
	$pdo= new PDO('mysql:host=localhost;dbname=store;charset=utf8','staff','password');
	if(is_array($contents_array)){
		foreach(array_keys($contents_array) as $type_key){
			echo '<h3>',$type_key,'一覧</h3>';
			foreach($contents_array[$type_key] as $innner_array){
				if(array_key_exists('title', $innner_array)){
					echo $innner_array['title'];
				}else if(array_key_exists('product_id', $innner_array)){
					$sql = $pdo->prepare('select product_name from product where product_id = ?');
					$sql->execute([$innner_array['product_id']]);
					foreach($sql as $row){
						echo $row['product_name'];
					}
				}

				echo '<form action="',$thisPage,'" method="post">';
				echo '<input type="hidden" name="command" value="delete">';
				echo '<input type="hidden" name="key_type" value="',$type_key,'">';
				echo '<input type="hidden" name="array_key" value="'
				,array_keys($contents_array[$type_key],$innner_array)[0],'">';
				echo '<input type="submit" value="削除">';
				echo '</form>';

				if($type_key=='news'){
					echo '<form action="staff_news.php" method="post">';
				}else if($type_key=='sale'){
					echo '<form action="staff_sale.php" method="post">';
				}else if($type_key=='ranking'){
					echo '<form action="staff_ranking.php" method="post">';
				}
				echo '<input type="hidden" name="command" value="edit">';
				echo '<input type="hidden" name="key_type" value="',$type_key,'">';
				echo '<input type="hidden" name="array_key" value="'
				,array_keys($contents_array[$type_key],$innner_array)[0],'">';
				echo '<input type="submit" value="編集">';
				echo '</form>';


			}

			echo '<hr>';
		}
	}
	if(isset($contents_array)){
		file_put_contents($text_file, json_encode($contents_array));
	}


?>