<div class = "row">
	<form action="?act=edit" method="POST">
		<h2>Edit your information</h2><br>
		<div class="form-group">
		  <label for="usr">Login:</label>
		  <input style="width: 500px" type="text" class="form-control" id="usr" name="login">
		</div>
		<div class="form-group">
		  <label for="pwd">Password:</label>
		  <input style="width: 500px" type="password" class="form-control" id="pwd" name="password">
		</div>
		<div class="form-group">
		  <label for="usr">Name:</label>
		  <input style="width: 500px" type="text" class="form-control" name="name">
		</div>
		<div class="form-group">
		  <label for="usr">Surname:</label>
		  <input style="width: 500px" type="text" class="form-control" name="surname">
		</div>
		<div class="form-group">
		  <label for="usr">Email:</label>
		  <input style="width: 500px" type="text" class="form-control" name="email" placeholder="Name@gmail.com">
		</div>
		<div class="form-group">
		  <label for="sel1">Age:</label>
		  <select style="width: 500px" class="form-control" id ="sel1" name="age">
			<?php
				for($i=5;$i<=100;$i++){
					echo "<option value=\"".$i."\">".$i."</option>";
				}
			?>
		  </select>
		</div>
		<div class="form-group">
			<input class="btn btn-success" type="submit" value="Change" style="width:150px"></input>
			<input class="btn btn-success" type="submit" value="Go Back"></input><br><br> 
				
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
				 Show your old information
				</button>

				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Old information</h4>
				      </div>
				      <div class="modal-body">
					    <?php
					    	$id = $_SESSION['user']['id'];
							
							$query = $connection->query("SELECT * FROM users WHERE id = $id");
							if($row=$query->fetch_object()){
								echo "<label>N A M E:</label> "." ".$row->name."<br>";	
								echo "<label>S U R N A M E:</label> "." ".$row->surname."<br>";	
								echo "<label>A G E:</label> "." ".$row->age."<br>";	
								echo "<label>L O G I N:</label> "." ".$row->login."<br>";	
								echo "<label>E M A I L:</label> "." ".$row->email."<br>";	
							
							}
						?>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>
				  </div>
				</div>

		</div>
	</form>
</div>	