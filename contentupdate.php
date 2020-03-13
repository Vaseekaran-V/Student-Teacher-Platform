<?php session_start();?>
<?php

	require_once('includes/conn.php');
	require_once('includes/functions.php');
	require_once('includes/header_signedin.php');
?>

<?php if(!isset($_SESSION['userid'])){

	header('Location:index.php');
}
?>

<?php

	$record=0;
	$string1=$_SESSION['userid'];

	$sql = "SELECT users.userid,users.firstname,users.lastname,users.gender,users.contactno,users.homecity,users.classtype,users.studenttype,subjects.subject_name,districts.district_name
	FROM users 
	JOIN users_subjects
	ON users_subjects.userid = users.userid 
	JOIN subjects 
	ON users_subjects.subjectid = subjects.subjectid
	JOIN users_districts
	ON users_districts.userid = users.userid
	JOIN districts
	ON users_districts.districtid = districts.districtid WHERE users.userid='".$string1."' ORDER BY users.userid;";

	$response = mysqli_query($conn,$sql);

	$all_records=similler_row_check($response);

	if($all_records[$record]['gender']=="male"){
	    
	    $name = 'Mr.'.' '.$all_records[$record]['firstname'].' '.$all_records[$record]['lastname'];
		}else{
		$name ='Mrs/Miss.'.' '.$all_records[$record]['firstname'].' '.$all_records[$record]['lastname'];
		}

	$subjects='';
	for ($x = 0; $x < count($all_records[$record]['subjects']); $x++) {

	 	$subjects = $subjects.$all_records[$record]['subjects'][$x].' , ';
	}
	$subjects  = rtrim($subjects,' , ');


	$districts='';
	for ($x = 0; $x < count($all_records[$record]['districts']); $x++) {
		$districts = $districts.$all_records[$record]['districts'][$x].' , ';
	}
	$districts = rtrim($districts,' , ');
?>

<main>
	<div class = "logged_user"><p><marquee>Welcome  <?php echo $_SESSION['firstname']; ?>! <a href ="Log_out.php">Log out</a></marquee> </p></div>
	<br>
<?php

echo"<img src='img/{$all_records[$record]['userid']}.jpg' width='500px' class='img'> <br>";

echo '<div class="table"><table class ="table_view" border="0">
<tr>
<td class="key"><b>Name</b></td>
<td>'.$name.'</td>
</tr>
<tr>
<td class="key"><b>Gender</b></td>
<td>'.$all_records[$record]['gender'].'</td>
</tr>
<tr>
<td class="key"><b>Contact Number</b></td>
<td>'.$all_records[$record]['contactno'].'</td>
</tr>
<tr>
<td class="key"><b>Home city</b></td>
<td>'.$all_records[$record]['homecity'].'</td>
</tr>
<tr>
<td class="key"><b>Class Type</b></td>
<td>'.$all_records[$record]['classtype'].'</td>
</tr>
<tr>
<td class="key"><b>Student Type</b></td>
<td>'.$all_records[$record]['studenttype'].'</td>
</tr>
<tr>
<td class="key"><b>Subjects</b></td>
<td>'.$subjects.'</td>
</tr>
<tr>
<td class="key"><b>Teaching District</b></td>
<td>'.$districts.'</td>
</tr>';

echo'</table> </div>';
echo '<br>';

mysqli_close($conn);

?>

	<br>
	<nav>	
		<a href ="Log_out.php" >Log out</a>
		<a href ='Delete_user.php?deluser=yes' >Delete the acount</a>
		<a href ="Update.php" >Update</a>
		<a href ="Updateimg.php" >Change profile picture</a>
	</nav>
	<br>
</main>
<?php require_once('includes/footer.php'); ?>