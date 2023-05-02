<div class="row">
	<h3>Write something intresting^_^</h3>
	<form action = "?act=send" method = "POST">
	<textarea class="form-control" rows="6" style = "width:600px" name = "tweet"></textarea><br>
	<button class="btn btn-info">send</button></a><br><br><br>
	</form>
	<br><br>
	<?php
		$query = $connection->query("SELECT * FROM tweets WHERE active = 1");
		while($row=$query->fetch_object()){
			if($row->active){
				$id_author = $row->user_id;
				$id_tweet = $row->id;
				$query_user = $connection->query("SELECT id, name,surname FROM users WHERE id = \"$id_author\"");
				if($row_user=$query_user->fetch_object()){
					echo "<h2>".$row_user->name." ".$row_user->surname." : </h2>";
				}
				echo "<h3>".$row->text."</h3><br>".$row->post_date." ";

				if($id_author == $_SESSION['user']['id']){
				?>
					<form>
						<input action = "?act=tdel&id=<?php echo $row->id;?>" method ="POST" class = "btn btn-success" type = "submit" value = "Delete"></input>
						<input action = "?act=tedit&id=<?php echo $row->id;?>" method = "POST" class = "btn btn-success" type = "submit" value = "Edit"></input>
					</form>
				<?php

				}?>
					<br><br>
				<?php

					$query_com = $connection->query("SELECT * FROM comments WHERE tweet_id = $row->id");
					while($row_com = $query_com->fetch_object()){
						if($row_com->active){
							$query_user_com = $connection->query("SELECT id,name,surname FROM users WHERE id = $row_com->user_id");
							if($row_user_com = $query_user_com->fetch_object()){
								echo $row_user_com->name.' '.$row_user_com->surname.' '." : ".'<br>';
							}

							echo $row_com->text.'<br><br>';
							echo $row_com->post_date.'<br>';
							if($row_com->user_id==$_SESSION['user']['id']){
								echo '<a href="?act=cdel&c_id='.$row_com->id.'&t_id='.$row->id.'">Delete</a><br>';
								echo '<a href="?act=cedit&c_id='.$row_com->id.'&t_id='.$row->id.'">Edit</a>';
							}

						}
					}


				?>
				
				<br><br><h5>Leave a Comment:</h5>
				    <form action = "?act=com" method = "POST">
				 	   <div class="form-group">
				            <textarea class="form-control" rows="3" style = "width:500px" name = "comment"></textarea>
				        </div>
				        <input type="hidden" name="t_id" value="<?php echo $row->id; ?>" ></input>
				    <button type="submit" class="btn btn-primary">Submit</button>
				    </form><br><br><?php

			}
		}
	?>

</div>