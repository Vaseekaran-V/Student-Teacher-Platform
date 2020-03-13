
<?php require_once('includes/conn.php');?>
 



<?php
	if(!isset($_GET['deluser'])){
	header('Location:index.php');
	}
	else{
	$delete_user = $_GET['deluser'];
	 
	

	$sql = "DELETE FROM users WHERE userid ='{$delete_user}';";
			
	$response = mysqli_query($conn,$sql);
	
	#if($response){echo "succesfull from users";}else{echo "error from users";}

	$sql ="DELETE FROM users_districts WHERE userid ='{$delete_user}';";

	$response = mysqli_query($conn,$sql);
	
	#if($response){echo "succesfull from users_districts";}else{echo "error from users_districts";}

	$sql =	"DELETE FROM users_subjects WHERE userid ='{$delete_user}';";

	$response = mysqli_query($conn,$sql);

	#if($response){echo "succesfull from users_subjects";}else{echo "error from users_subjects";}


	mysqli_close($conn);
	$delete_from='img/';
	$image = $delete_from.$delete_user.'.'.'jpg';
	if (!unlink($image)){
		echo "Error deleting $image";
	}else{
		header('Location:Login.php?del=yes'); 
	}

	

}
?>