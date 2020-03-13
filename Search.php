
<?php require_once('includes/header_search.php'); ?>
<?php require_once('includes/conn.php');?>
<?php require_once('includes/functions.php');?>

<main>
	<h1>Search</h1>
<div class="search_containor1">
<form action="Search.php" method="post" >
   
 
 	<label for="district"><b>District:</b></label>
 	<select name="district" id="district">
 		  <option value="all">All</option>
    	<option value="colombo">Colombo</option>
  		<option value="kalutara">Kalutara</option>
  		<option value="gampaha">Gampaha</option>
  		<option value="galle">Galle</option>
  		<option value="matara">Matara</option>
  		<option value="kurunagala">Kurunagala</option>
  		<option value="anuradhapura">Anuradhapura</option>
  		<option value="polonnaruwa">Polonnaruwa</option>
  		<option value="jaffna">Jaffna</option>
	</select>

	<label for="subject"><b>Subject:</b></label>
 	<select name="subject" id="subject">
    <option value="all">All</option>
    <option value="Maths">Maths</option>
    <option value="Science">Science</option>
    <option value="Eastern Music">Eastern Music</option>
    <option value="Western Music Music">Western Music</option>
    <option value="Sinhala">Sinhala</option>
    <option value="Tamil">Tamil</option>
    <option value="English">English</option>
    <option value="A/L Combined Maths">Combined Maths</option>
    <option value="A/L Biology">A/L Biology</option>
    <option value="History">History</option>
    <option value="Commerce">Commerce</option>
    <option value="Geography">Geography</option>
    <option value="A/L Computer Scienc">A/L Computer Scienc</option>
	</select>

	<label for="studenttype"><b>Student Type</b></label>
    
  <select name="studenttype" id="studenttype">
    	<option value="primary_level">Primary level</option>
  		<option value="secondary_level">Secondary level</option>
  		<option value="advanced_level">Advanced level</option>
  		
	</select>

	<label for="classtype"><b>Class Type</b></label>
 	<select name="classtype" id="classtype">
    	<option value="Individual">Individual</option>
  		<option value="Group">Group</option>
  		<option value="Both">Both</option>
	</select>
              
  <button type="submit" name="submit" class="submit_button">Submit</button>


    </div>
</form>
<?php

if( isset($_POST['submit']) ){
    
  

    $district_option=$_POST['district'];
    $subject_option=$_POST['subject'];
    $studenttype_option=$_POST['studenttype'];
    $classtype_option=$_POST['classtype'];

    if ($district_option != "all" and $subject_option !="all") {
    $string1 ="WHERE users.studenttype = '{$studenttype_option}' AND users.classtype = '{$classtype_option}' AND districts.district_name = '{$district_option}' AND subjects.subject_name = '{$subject_option}' ";
    }
    if ($district_option == "all" and $subject_option =="all") {
    $string1 ="WHERE users.studenttype = '{$studenttype_option}' AND users.classtype = '{$classtype_option}' ";
    }
    else if ($district_option == "all" and $subject_option !="all" ) {
    $string1 ="WHERE users.studenttype = '{$studenttype_option}' AND users.classtype = '{$classtype_option}' AND subjects.subject_name = '{$subject_option}' ";
    }
    else if ($subject_option =="all" and $district_option != "all" ) {
    $string1 ="WHERE users.studenttype = '{$studenttype_option}' AND users.classtype = '{$classtype_option}' AND districts.district_name = '{$district_option}' ";
    }

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

/*
echo '<br>';
echo $sql;
*/
$response = mysqli_query($conn,$sql);

$all_records=similler_row_check($response);
echo'<div class ="search_info">';

echo'<p>';
echo'Teaching district: '.$district_option.'<br>';
echo'Subject : '.$subject_option;
echo'</p>';
echo'<p>';
echo'Student Type: '.$studenttype_option.'<br>';
echo'Class Type: '.$classtype_option;
echo'</p>';
echo'</div>';

echo'<table class ="table_view">';
for ($x = 0; $x < count($all_records); $x++) {
    $y = $x+1;
    echo "<tr>";
    echo "<td>".$y."</td>";
    echo "<td>";
    if($all_records[$x]['gender']=="male"){
    
    echo 'Mr.'.' '.$all_records[$x]['firstname'].' '.$all_records[$x]['lastname'];
  }else{
  echo 'Mrs/Miss.'.' '.$all_records[$x]['firstname'].' '.$all_records[$x]['lastname'];
  }
  echo "</td>";
  echo "<td> <img src='img/{$all_records[$x]['userid']}.jpg' width='150px'> </td>";
  echo '<td> <a href = "view_profile.php?sql_link='.$string1.'&record='.$x.'&">View Profile</a> </td>';
  
    echo "</tr>";
}
echo'</table>';
mysqli_close($conn);


}
 
 ?>
</main>

<div class="empty_weight"></div>
<?php require_once('includes/footer.php'); ?>