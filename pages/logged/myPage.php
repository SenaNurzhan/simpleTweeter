<div class="row">
	<header class="jumbotron hero-spacer">
        <?php
            $id = $_SESSION['user']['id'];
				$query = $connection->query("SELECT * FROM users WHERE id = $id");
				if($row=$query->fetch_object()){

					echo "<h1>"." ".$row->name." ".$row->surname."</h1><br>";
					echo "<h4> <label>A G E :</label> "." ".$row->age."</h4><br>";
					echo "<h4> <label>L O G I N :</label> "." ".$row->login."</h4><br>";
					echo "<h4> <label>E M A I L :</label> "." ".$row->email."</h4><br>";

				}
		?>
    </header>
    <hr>
    <?php
    	$query = $connection->query("SELECT * FROM tweets WHERE user_id = $id");
			while($row=$query->fetch_object()){

				echo "<h4>".$row->text."</h4><br>".$row->post_date."";
				
				$_id = $_SESSION['user']['id'];
				if($_id == $_SESSION['user']['id']){
				?>
					<form action = "?act=tdel&id=<?php echo $row->id;?>" method = "POST">
						<input class="btn btn-success" type="submit" value="Delete"></input>
					</form><br><br>
				<?php	
			}
			
				}?>
	
</div>