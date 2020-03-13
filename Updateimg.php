<?php session_start();?>
<?php

	require_once('includes/conn.php');
	require_once('includes/functions.php');
	 
?>


<?php if(!isset($_SESSION['userid'])){

	header('Location:index.php');}
?>

<?php


 $erros = array();
 if (isset($_POST['submit'])) {
 	 
 	$delete_user = $_SESSION['userid'];
	$delete_from='img/';
	$image = $delete_from.$delete_user.'.'.'jpg';
	if (!unlink($image)){
		echo "Error deleting $image";

	}



 	$file_name=$_SESSION['userid'].'.'.'jpg';
	$file_type=$_FILES['image']['type'];
 	$file_size=$_FILES['image']['size'];
 	$temp_name=$_FILES['image']['tmp_name'];
 	$upload_to='img/';
   
 	// checking the file type
 	if ($file_type != 'image/jpeg') {
 	   $erros[]='Only JPEG files are allowed';
	}
	// checking the file size
	if ($file_size> 500000) {
 	   $erros[]='File size should not exceed the 500kb limit.';
	}
	if (empty($erros)) {
		$file_uploaded = move_uploaded_file($temp_name, $upload_to.$file_name);

		header('Location:contentupdate.php?imageupdate=yes');
	}

	 
 	
 	 
 } 
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>image Uplaod</title>
	<style type="text/css">
		.container{ width: 960px ;margin: 0 auto;  }
		.errors{color:red;}
	</style>
</head>
<body>
<div class = "container">
<h1>Upload images</h1>
<h3>Choose an image and click uplaod</h3>

<?php
 if (!empty($erros)) {
 	 echo '<div class = "errors">';
 	 foreach ($erros as $error) {
 	 	echo "-".$error."<br>";
 	 }
 	 echo '</div>';
 }


?>

<form action="Updateimg.php" method="post" enctype="multipart/form-data">
	<input type="file" name="image" id="">
	<button type="submit" name="submit" >Upload</button>
</form>
</div>

</body>
</html>