<?php session_start();?>
<?php require_once('includes/header_login.php'); ?>
<?php require_once('includes/conn.php'); ?>
<?php

if( isset($_POST['submit']) ){

	$errors = array(); 	 
 	if( !isset($_POST['username']) || strlen(trim($_POST['username']))< 1 ){
 		$errors[] = "Username is missing/Invalid";
	}
	
	if (!isset($_POST['password']) || strlen(trim($_POST['password']))< 1  ) {
		$errors[] = "password is missing/Invalid";
	}

	if(empty($errors)){
	
	$username=$_POST['username'];
	$password=$_POST['password'];

	$hashed_password = sha1($password);
    // LIMIT use for 1 get one record
	$sql = "SELECT * FROM users
	WHERE username = '{$username}'
	AND password = '{$hashed_password}'
	LIMIT 1";

	$response = mysqli_query($conn,$sql);
	if($response){
      //echo 'query successful....';
     
	    if(mysqli_num_rows($response)==1){
	    	$user =mysqli_fetch_assoc($response);
	    	if(strtolower($username)=="admin"){
	    		$_SESSION['adminuserid']= $user['userid']; 
	    		header('Location:admin.php');


	    	}else{

	    	$_SESSION['userid']= $user['userid']; 
	    	$_SESSION['firstname']= $user['firstname']; 
	    	$_SESSION['email']= $username;
	    	// if all going right then redirect to a another page
	      header('Location:contentupdate.php');
	  	}
	    } 
	    else{
	      $errors[] = "Invalid Username/password";
	      //echo 'Something Wrong....'.mysqli_error($conn);
	    }
	}else{
		 $errors[] = "Database querie Failed";
	}

	}  

 }

?>

<div class="login_image">
<div class ="login">
	<form action ="login.php" method="post">	
		<fieldset>
			<legend><h1> Login </h1></legend>

				<?php
				if( isset($errors) && !empty($errors)){
					echo'<p class ="error">'. $errors[0] .'</p>';
					
				}
				?>

				<?php
				if( isset($_GET['logout']) ){
					echo'<p class ="info"> You have succesfully logout from the system </p>';
					
				}
				?>

				<?php
				if( isset($_GET['del']) ){
					echo'<p class ="info_del"> You have succesfully deleted your account. </p>';
					
				}
				?>

				<?php
				if( isset($_GET['registerd']) ){
					echo'<p class ="info"> You have succesfully Created a account. </p>';
					
				}
				?>
				

				<p>
				<label>User name:</label>
				<input type="text" name="username" placeholder="Username" >
				</p>

				<p>
				<label>Password:</label>
				<input type="password" name="password" placeholder="password" >
				</p>

				<p>
				<button type="submit" name="submit" >Login</button>
				</p>
		</fieldset>
	</form>
</div> 
</div>
  
<?php require_once('includes/footer.php'); ?>