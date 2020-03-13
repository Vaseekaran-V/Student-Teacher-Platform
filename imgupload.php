<?php

 session_start();



 $erros = array();
 if (isset($_POST['submit'])) {
 	# code...
 	 
 	#$file_name=$_FILES['image']['name'];

 	$file_name=$_SESSION['image_name'].'.'.'jpg';
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

		$_SESSION = array();
		 
		if (isset($_COOKIE[session_name()])){
			setcookie(session_name(),'',time()-86400,'/');
		}

		session_destroy();
		header('Location:Login.php?registerd=yes');
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
 else{



 }
  ?>
<form action="imgupload.php" method="post" enctype="multipart/form-data">
	<input type="file" name="image" id="">
	<button type="submit" name="submit" >Upload</button>
</form>

 
<?php if (isset($file_uploaded)&&$file_uploaded) {
	echo "<h3> {$file_name} Uploaded succesfully</h3>";
}  

?>
</div>
</body>
</html>

