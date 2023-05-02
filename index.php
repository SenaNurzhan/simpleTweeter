<?php

	include "templates/db.php";

	$page = "home";

	$login = "";

	$password = "";

	$online = false;

	session_start();

	if(isset($_GET['page'])){
		if($_GET['page'] == "home"){
			$_SESSION['page'] = $page;
			$page = "home";
		}else if($_GET['page'] == "registration"){
			$_SESSION['page'] = $page;
			$page = "registration";
		}
	}

	if(isset($_SESSION['user'])){ 

		$user = $_SESSION['user']; 

			$add = "SELECT * FROM users WHERE id =\"".$user['id']."\" AND password =\"".$user['password']."\""; 


			$queryy = $connection->query($add); 

				if( $row = $queryy->fetch_array() ){
							$_SESSION['user'] = $row;   // $_SESSION['user']['id']     $_SESSION['user']['login'];
							$page = "myPage";
							$online = true;
				}
		
	} 

		if($online){
			
			if( isset($_GET['page']) ){
				if( $_GET['page'] == "myPage" ){
					$page = "myPage";
				}else if( $_GET['page'] == "tweets" ){
					$page = "tweets";
				}else if($_GET['page'] == "Settings"){
					$page = "Settings";
				}
			}

			if ( isset($_GET['act']) ){
				if($_GET['act'] == "logout"){

					$online = false;
					//session_unset($_SESSION['user']);
					unset($_SESSION['user']);
					$page = "home";

				}else if($_GET['act'] == "edit"){

					$_id = $_SESSION['user']['id'];

					$query = $connection->query("SELECT * FROM users WHERE id = $_id");
					if($row=$query->fetch_object()){
						$login = $_POST['login'];
						$password = sha1($_POST['password']);
						$name = $_POST['name'];
						$surname = $_POST['surname'];
						$age = $_POST['age'];
						$email = $_POST['email'];
						$query = $connection->query("UPDATE users SET login = \"$login\", password = \"$password\",name = \"$name\",surname = \"$surname\",age = \"$age\",email = \"$email\" WHERE id = $_id ");
					}

				}else if($_GET['act'] == "send"){
					
					$user_id = $_SESSION['user']['id'];
					$tweet = $_POST['tweet'];

					$connection->query("INSERT INTO tweets(id,user_id,text,post_date,active)
										VALUES(NULL,\"$user_id\",\"$tweet\",NOW(),1)");

				}else if($_GET['act'] == "com"){
					$userid = $_SESSION['user']['id'];
					$tid = $_POST['t_id'];
					$comment = $_POST['comment'];
					$connection->query("INSERT INTO comments(id,user_id,tweet_id,text,post_date,active)
										VALUES(NULL,$userid,$tid, \"$comment\", NOW(), 1 )");
					$page = "tweets";
					
	
				}else if($_GET['act'] == "tdel"){

					$_id = $_SESSION['user']['id'];
					$t_id = $_GET['id'];
					$delete = $connection->query("DELETE FROM tweets WHERE user_id = $_id AND id = $t_id");

				}else if($_GET['act'] == "tedit"){

					$__id = $_SESSION['user']['id'];
					$t__id = $_GET['id'];
					$tw = $_POST['tweet'];
					$tw_edit = $connection->query("SELECT * FROM tweets WHERE user_id = $__id AND id = $t__id");
					if($row=$tw_edit->fetch_object()){
						$query = $connection->query("UPDATE tweets SET text = \"$tw\" WHERE user_id = $__id AND id = $t__id");
					}	

				}else if($_GET['act'] == "cdel"){

					$_user_id = $_SESSION['user']['id'];
					$_t_id = $_GET['t_id'];
					$_c_id = $_GET['c_id'];
					$del = $connection->query("DELETE FROM comments WHERE user_id = $_user_id AND tweet_id = $_t_id AND id = $_c_id");

				}else if($_GET['act'] == "deactive"){
					$user_id = $_SESSION['user']['id'];
					$deactive = $connection->query("UPDATE users SET active = 0 WHERE id = $user_id ");

					$online = false;
					$page = "home";
				}
			}

		}else{

			if(isset($_GET['act'])){
				if($_GET['act'] == 'login'){
						$login = $_POST['login'];
						$password = sha1($_POST['password']);
						$query = $connection->query("SELECT id,login,password FROM users WHERE login = \"$login\" AND password = \"$password\" AND active = 1 ");

						if( $row = $query->fetch_array() ){
							$_SESSION['user'] = $row;   // $_SESSION['user']['id']     $_SESSION['user']['login'];
							$page = "myPage";
							$online = true;
						}else{
							$page = "home";
							$online = false;
						}


				}else if($_GET['act'] == 'reg'){
					$login = $_POST['login'];
					$password = sha1($_POST['password']);
					$name = $_POST['name'];
					$surname = $_POST['surname'];
					$age = $_POST['age'];
					$email = $_POST['email'];
					$connection->query("INSERT INTO users(id,name,surname,login,password,age,email,active)
										VALUES(NULL,\"$name\",\"$surname\",\"$login\",\"$password\",\"$age\",\"$email\",1)");

				}else if($_GET['act'] == "back"){

					$page = "home";

				}
			}
		}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sena's Tweeter</title>

    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>
</head>

<body>

    <?php
    
        if($online){
        	include 'templates/header_menu.php';
		}    
    ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12">

                <?php
                
                    if($online == true){
                    	include 'pages/logged/'.$page.'.php';
                    }else if($online == false){	
                    	include 'pages/notlogged/'.$page.'.php';
                    }
                
                ?>
            
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
        <br><br><br><br><br>
        <?php

            include 'templates/footer.php';
        ?>

    <!-- jQuery Version 1.11.1 -->
    <script src="bootstrap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>