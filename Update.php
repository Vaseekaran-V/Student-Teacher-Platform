<?php session_start();?>
<?php

	require_once('includes/conn.php');
	require_once('includes/functions.php');
	require_once('includes/header.php');
	$userid = $_SESSION['userid'];
    $email=$_SESSION['email'] ;
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

	 $z1=$all_records[$record]['districts'];
	 $z2=$all_records[$record]['subjects'];
?>





<?php
if( isset($_POST['submit']) ){


  

  if($_POST['psw'] == $_POST['psw-repeat']){

  $errors = array();   
  $userid = $_SESSION['userid'];
   

  $username=mysqli_real_escape_string($conn,$_POST['email']);
  $password=mysqli_real_escape_string($conn,$_POST['psw']); 
  $hashed_password = sha1($password);
  $firstname=mysqli_real_escape_string($conn,$_POST['firstname']); 
  $lastname=mysqli_real_escape_string($conn,$_POST['lastname']);
  $gender=mysqli_real_escape_string($conn,$_POST['gender']); 
  $contactno=mysqli_real_escape_string($conn,$_POST['contactno']); 
  $homecity=mysqli_real_escape_string($conn,$_POST['homecity']);
  $classtype=mysqli_real_escape_string($conn,$_POST['classtype']); 
  $studenttype=mysqli_real_escape_string($conn,$_POST['studenttype']);
  
  
  $district_ids   = array(); 


  if(isset($_POST['district1'])){
        $district_ids[]=$_POST['district1'];
  }
  if(isset($_POST['district2'])){
        $district_ids[]=$_POST['district2'];
  }
  if(isset($_POST['district3'])){
        $district_ids[]=$_POST['district3'];
  }
  if(isset($_POST['district4'])){
        $district_ids[]=$_POST['district4'];
  }
  if(isset($_POST['district5'])){
        $district_ids[]=$_POST['district5'];
  }
  if(isset($_POST['district6'])){
        $district_ids[]=$_POST['district6'];
  }
  if(isset($_POST['district7'])){
        $district_ids[]=$_POST['district7'];
  }

  if(isset($_POST['district8'])){
       $district_ids[]=$_POST['district8'];
  }
  
  if(isset($_POST['district9'])){
       $district_ids[]=$_POST['district9'];
  }

  $subjects_ids  = array();
  
    

  if(isset($_POST['subjects1'])){
        $subjects_ids[]=$_POST['subjects1'];
  }
  if(isset($_POST['subjects2'])){
        $subjects_ids[]=$_POST['subjects2'];
  }
  if(isset($_POST['subjects3'])){
        $subjects_ids[]=$_POST['subjects3'];
  }
  if(isset($_POST['subjects4'])){
        $subjects_ids[]=$_POST['subjects4'];
  }
  if(isset($_POST['subjects5'])){
        $subjects_ids[]=$_POST['subjects5'];
  }
  if(isset($_POST['subjects6'])){
        $subjects_ids[]=$_POST['subjects6'];
  }
  if(isset($_POST['subjects7'])){
        $subjects_ids[]=$_POST['subjects7'];
  }

  if(isset($_POST['subjects8'])){
       $subjects_ids[]=$_POST['subjects8'];
  }  

  if(isset($_POST['subjects9'])){
        $subjects_ids[]=$_POST['subjects9'];
  }
  if(isset($_POST['subjects10'])){
        $subjects_ids[]=$_POST['subjects10'];
  }
  if(isset($_POST['subjects11'])){
        $subjects_ids[]=$_POST['subjects11'];
  }
  if(isset($_POST['subjects12'])){
        $subjects_ids[]=$_POST['subjects12'];
  }
  if(isset($_POST['subjects13'])){
       $subjects_ids[]=$_POST['subjects13'];
  }   





  #print_r($subjects_ids);
  #print_r($district_ids);
  
  $sql ="UPDATE users SET
  username='{$username}',
  password='{$hashed_password}',
  firstname='{$firstname}',
  lastname='{$lastname}',
  gender='{$gender}',
  contactno='{$contactno}',
  homecity='{$homecity}',
  classtype='{$classtype}',
  studenttype='{$studenttype}' WHERE userid ='{$userid}';";
  
  #echo $sql;

  $response = mysqli_query($conn,$sql);

  
  $link_sql1='';
  for ($i=0; $i <count($district_ids) ; $i++) { 
       $link1 = "({$userid},{$district_ids[$i]}),";
       $link_sql1 = $link_sql1.$link1;
      } 

  $link_sql1 = rtrim($link_sql1,',');


  $link_sql2='';
  for ($i=0; $i <count($subjects_ids) ; $i++) { 
       $link2 = "({$userid},{$subjects_ids[$i]}),";
       $link_sql2 = $link_sql2.$link2;
      } 

  $link_sql2 = rtrim($link_sql2,',');

  #echo $link_sql1;
  #echo '<br>';
  #echo $link_sql2;




  $sql ="DELETE FROM users_districts WHERE userid ='{$userid}';";

  $response = mysqli_query($conn,$sql);
	
	 
	
  $sql =	"DELETE FROM users_subjects WHERE userid ='{$userid}';";

  $response = mysqli_query($conn,$sql);



  $sql="INSERT INTO users_districts( userid, districtid) VALUES {$link_sql1};";

  $response = mysqli_query($conn,$sql);

  $sql="INSERT INTO users_subjects ( userid, subjectid) VALUES {$link_sql2};";

  $response = mysqli_query($conn,$sql);



  mysqli_close($conn);


  header("Location:contentupdate.php");  

  }else{echo '<h1>Incorrect password</h1>';}  


 }

?>	









<main>
 <div class="container">
    <form action="Update.php" method="post">
  
    <h1>Register as a Teacher or Instructor</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="firstname"><b>First Name</b></label>
    <input type="text" placeholder="Enter First Name" name="firstname" required  value =<?php echo"'{$all_records[$record]['firstname']}'" ;?>>

    

    <label for="lastname"><b>Last Name</b></label>
    <input type="text" placeholder="Enter Last Name" name="lastname" required value =<?php echo"'{$all_records[$record]['lastname']}'"; ?>>

    

    <label for="email"><b>Email(User name)</b></label>
    <input type="email" placeholder="Enter Email" name="email" required value =<?php echo"'{$email}'"; ?>>

    

    <label for="email"><b>Contact number</b></label>
    <input type="text" placeholder="Enter Contact number" name="contactno" required value =<?php echo"'{$all_records[$record]['contactno']}'"; ?>>

    

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>


    

    <label for="gender"><b>Gender</b></label>
    <select name="gender" id="gender">


      <option value="female" <?php if($all_records[$record]['gender']=="female"){echo"selected";} ?>>Female</option>


      <option value="male" <?php if($all_records[$record]['gender']=="male"){echo"selected";} ?>>Male</option>
    </select>
  

    

    <label for="classtype"><b>Class Type</b></label>
    <select name="classtype" id="classtype">


      <option value="Individual" <?php if($all_records[$record]['classtype']=="Individual"){echo"selected";} ?> >Individual</option>


      <option value="Group" <?php if($all_records[$record]['classtype']=="Group"){echo"selected";} ?> >Group</option>


      <option value="Both" <?php if($all_records[$record]['classtype']=="Both"){echo"selected";} ?> >Both</option>


    </select>


    

    <label for="studenttype"><b>Student Type</b></label>
    <select name="studenttype" id="studenttype">


      <option value="primary_level" <?php if($all_records[$record]['studenttype']=="primary_level"){echo"selected";} ?> >Primary level</option>


      <option value="secondary_level" <?php if($all_records[$record]['studenttype']=="secondary_level"){echo"selected";} ?>>Secondary level</option>


      <option value="advanced_level" <?php if($all_records[$record]['studenttype']=="advanced_level"){echo"selected";} ?>>Advanced level</option>


    </select>
  

    <label for="homecity"><b>Home City</b></label>
    <input type="text" placeholder="Enter the name of your HomeCity" name="homecity" required value =<?php echo"'{$all_records[$record]['homecity']}'"; ?>>

    <?php if(in_array("Kalutara",$z1 )){echo"checked";}?>



    <label for="district"><b>Teaching Areas</b></label>

    <div class="checkbox_areas">

    <div class="checkbox_areas_sub">Colombo<input type="checkbox" name="district1" value='1' <?php if(in_array("Colombo",$z1 )){echo"checked";}?>  ></div>


    <div class="checkbox_areas_sub">Kalutara<input type="checkbox" name="district2" value='2'  <?php if(in_array("Kalutara",$z1 )){echo"checked";}?>  ></div>


    <div class="checkbox_areas_sub">Gampaha<input type="checkbox" name="district3" value='3'  <?php if(in_array("Gampaha",$z1 )){echo"checked";}?>  ></div>


    <div class="checkbox_areas_sub">Galle<input type="checkbox" name="district4" value='4'   <?php if(in_array("Galle",$z1 )){echo"checked";}?>   ></div>


    <div class="checkbox_areas_sub">Matara<input type="checkbox" name="district5" value='5'   <?php if(in_array("Matara",$z1 )){echo"checked";}?>  > </div>


    <div class="checkbox_areas_sub">Kurunagala<input type="checkbox" name="district6" value='6'   <?php if(in_array("Kurunagala",$z1 )){echo"checked";}?>  ></div>


    <div class="checkbox_areas_sub">Anuradhapura<input type="checkbox" name="district7" value='7'   <?php if(in_array("Anuradhapura",$z1 )){echo"checked";}?>  ></div>


    <div class="checkbox_areas_sub">Polonnaruwa<input type="checkbox" name="district8" value='8'   <?php if(in_array("Polonnaruwa",$z1 )){echo"checked";}?>  ></div>


    <div class="checkbox_areas_sub">Jaffna<input type="checkbox" name="district9" value='9'   <?php if(in_array("Jaffna",$z1 )){echo"checked";}?> ></div>


    <div class="clr"></div>
    </div>

    <div class="clr"></div>
    
    <label for="Subjects"><b>Subjects</b></label>


    <div class="checkbox_areas">

    <div class="checkbox_areas_sub">Maths<input type="checkbox" name="subjects1" value='1' <?php if(in_array("Maths",$z2 )){echo"checked";}?>  ></div>


    <div class="checkbox_areas_sub">Science<input type="checkbox" name="subjects2" value='2' <?php if(in_array("Science",$z2 )){echo"checked";}?> ></div>


    <div class="checkbox_areas_sub">Sinhala<input type="checkbox" name="subjects3" value='3'  <?php if(in_array("Sinhala",$z2 )){echo"checked";}?>  ></div>

    <div class="checkbox_areas_sub">Tamil<input type="checkbox" name="subjects4" value='4'  <?php if(in_array("Tamil",$z2 )){echo"checked";}?>  ></div>

    <div class="checkbox_areas_sub">English<input type="checkbox" name="subjects5" value='5'  <?php if(in_array("English",$z2 )){echo"checked";}?>>  </div>

    <div class="checkbox_areas_sub">History<input type="checkbox" name="subjects6" value='6'  <?php if(in_array("History",$z2 )){echo"checked";}?>>  </div>

    <div class="checkbox_areas_sub">Eastern music<input type="checkbox" name="subjects7" value='7'  <?php if(in_array("Eastern music",$z2 )){echo"checked";}?>>  </div>

    <div class="checkbox_areas_sub">Western music<input type="checkbox" name="subjects8" value='8'  <?php if(in_array("Western music",$z2 )){echo"checked";}?>>  </div>

    <div class="checkbox_areas_sub">Commerce <input type="checkbox" name="subjects9" value='9'  <?php if(in_array("Commerce",$z2 )){echo"checked";}?>>  </div>

    <div class="checkbox_areas_sub">A/L Combined Maths<input type="checkbox" name="subjects10" value='10'  <?php if(in_array("A/L Combined Maths",$z2 )){echo"checked";}?>>  </div>

    <div class="checkbox_areas_sub">A/L Biology<input type="checkbox" name="subjects11" value='11'  <?php if(in_array("A/L Biology",$z2 )){echo"checked";}?>>  </div>

    <div class="checkbox_areas_sub">Geography<input type="checkbox" name="subjects12" value='12'  <?php if(in_array("Geography",$z2 )){echo"checked";}?>>  </div>

    <div class="checkbox_areas_sub">A/L Computer Science<input type="checkbox" name="subjects13" value='13'  <?php if(in_array("A/L Computer Science",$z2 )){echo"checked";}?>>  </div>
    
  
    </div>

    <hr>


    
    <button type="submit" class="registerbtn" name="submit">Register</button>
  

    </form>

  </div>
</main>










<?php require_once('includes/footer.php'); ?>