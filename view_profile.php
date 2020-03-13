<?php
require_once('includes/header_profile.php');
require_once('includes/conn.php');
require_once('includes/functions.php');

$record=$_GET['record'];
$string1=$_GET['sql_link'];

echo '<h1 class="head"> Profile</h1><hr>';

$sql = "SELECT users.userid,users.firstname,users.lastname,users.gender,users.contactno,users.homecity,users.classtype,users.studenttype,subjects.subject_name,districts.district_name
FROM users 
JOIN users_subjects
ON users_subjects.userid = users.userid 
JOIN subjects 
ON users_subjects.subjectid = subjects.subjectid
JOIN users_districts
ON users_districts.userid = users.userid
JOIN districts
ON users_districts.districtid = districts.districtid ".$string1." "."ORDER BY users.userid;";

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

echo"<img class='img' src='img/{$all_records[$record]['userid']}.jpg' width='200px' height='200px' style='margin-left:42%;margin-right:40%;border-radius:20px;'>";

echo '<div class="table"> <table class ="table_view" border="0">
<tr>
<td><b>Name</b></td>
<td>'.$name.'</td>
</tr>
<tr>
<td><b>Gender</b></td>
<td>'.$all_records[$record]['gender'].'</td>
</tr>
<tr>
<td><b>Contact Number</b></td>
<td>'.$all_records[$record]['contactno'].'</td>
</tr>
<tr>
<td><b>Home city</b></td>
<td>'.$all_records[$record]['homecity'].'</td>
</tr>
<tr>
<td><b>Class Type</b></td>
<td>'.$all_records[$record]['classtype'].'</td>
</tr>
<tr>
<td><b>Student Type</b></td>
<td>'.$all_records[$record]['studenttype'].'</td>
</tr>
<tr>
<td><b>Subjects</b></td>
<td>'.$subjects.'</td>
</tr>
<tr>
<td><b>District</b></td>
<td>'.$districts.'</td>
</tr>';

echo'</table>';
echo'</div>';

mysqli_close($conn);
?>