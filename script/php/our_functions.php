<?php

	function createLink($link_array){
		echo '<a href="';
		echo $link_array[0];
		echo '">';
		echo $link_array[1];
		echo '</a>';
	}

	function createTableTitles($title_array){
		echo '<tr>';
		foreach ($title_array as $title) {
			echo '<th>',$title,'</th>';
		}
		echo '</tr>';
	}

	function showDataTable($titles_array,$sql_array,$key_array){
		echo '<table>';
		createTableTitles($titles_array);

		foreach($sql_array as $row){
			echo '<tr>';
			foreach($key_array as $key){
				echo '<td>';
				echo $row[$key];
				echo '</td>';
			}
			echo '</tr>';
		}
		echo '</table>';
	}
	
	function showTitles($title_array){
		foreach ($title_array as $title) {
			echo '<div class="title">',$title,'</div>';
		}
	}

	function editDataTable($title_array,$sql_array,$key_array,$editable_array,$postPagePass){
		showTitles($title_array);
		echo '<br>';

		foreach($sql_array as $row){
			echo '<form class="ib" action="',$postPagePass,'" method="post">';
			echo '<input type="hidden" name="command" value="update">';
			foreach($key_array as $key){
				if($editable_array[$key]){
					echo '<div class="tableItems">';
					echo '<input type="text" name="',$key,'" value="',$row[$key],'">';
					echo '</div>'; 
				}else{
					echo '<div class="tableItems">';
					echo '<input type="hidden" name="',$key,'" value="',$row[$key],'">';
					echo $row[$key];
					echo '</div>';
				}
			}
			echo '<input type="submit" value="更新">';
			echo '</form>';

			echo '<form class="ib" action="',$postPagePass,'" method="post">';
			echo '<input type="hidden" name="command" value="delete">';
			echo '<input type="hidden" name="',$key_array[0];
			echo '" value="';
			echo $row[$key_array[0]],'">';
			echo '<input type="submit" value="削除">';
			echo '</form>';
			echo '<br>';
		}
		echo '<form action="',$postPagePass,'" method="post">';
		echo '<input type="hidden" name="command" value="insert">';
		foreach($key_array as $key){
			if($editable_array[$key]){
				echo '<div class="tableItems">';
				echo '<input type="text" name="',$key,'" value="">';
				echo '</div>'; 
			}else{
				echo '<div class="tableItems">';
				echo '入力不可';
				echo '</div>';
			}
		}
		echo '<input type="submit" value="追加">';
		echo '</form>';
	}

	function editProductTable($title_array,$sql_array,$key_array,$editable_array,$postPagePass){
		showTitles($title_array);
		echo '<br>';

		foreach($sql_array as $row){
			echo '<form class="ib" action="',$postPagePass,'" method="post">';
			echo '<input type="hidden" name="command" value="update">';
			foreach($key_array as $key){
				if($editable_array[$key]){
					echo '<div class="editItems">';
					echo '<input class="textbox" type="text" name="',$key,'" value="',$row[$key],'">';
					echo '</div>'; 
				}else{
					echo '<div class="NotEditItems">';
					echo '<input type="hidden" name="',$key,'" value="',$row[$key],'">';
					echo $row[$key];
					echo '</div>';
				}
			}
			echo '<input type="submit" value="更新">';
			echo '</form>';

			echo '<form class="ib" action="',$postPagePass,'" method="post">';
			echo '<input type="hidden" name="command" value="delete">';
			echo '<input type="hidden" name="product_id" value="';
			echo $row[$key_array[0]],'">';
			echo '<input type="hidden" name="product_name" value="';
			echo $row['product_name'],'">';
			echo '<input type="submit" value="販売停止">';
			echo '</form>';
			echo '<br>';
		}
		echo '<form action="',$postPagePass,'" method="post">';
		echo '<input type="hidden" name="command" value="insert">';
		foreach($key_array as $key){
			if($editable_array[$key]){
				echo '<div class="tableItems">';
				echo '<input type="text" name="',$key,'" value="">';
				echo '</div>'; 
			}else{
				echo '<div class="tableItems">';
				echo '入力不可';
				echo '</div>';
			}
		}
		echo '<input type="submit" value="追加">';
		echo '</form>';
	}

?>