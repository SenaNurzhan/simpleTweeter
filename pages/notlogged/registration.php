<div class="row">
	<form action="?act=reg" method="POST">
	<h3>REGISTRATION</h3><br>	
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
			<input class = "btn btn-success" type = "submit" value = "Register" style = "width:150px"></input>
		</div>
	</form>
		<a href = "?act=back" class = "btn btn-info" style = "width:150px">Go Back</a>
</div>