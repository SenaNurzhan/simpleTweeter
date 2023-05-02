<?php

	$connection = new mysqli("localhost","root","","project_1");

	if($connection->connect_error){

		echo "Error with database connection";

	}

?>