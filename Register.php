
<?php session_start();?>
<?php require_once('includes/header_register.php'); ?>
<?php require_once('includes/conn.php');?>
<main>
<?php

if( isset($_POST['submit']) ){

  if($_POST['psw'] == $_POST['psw-repeat']){

  $errors = array();   
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
  
  $sql ="INSERT INTO users ( username, password, firstname, lastname, gender,  contactno, homecity,classtype,studenttype) VALUES ('{$username}', '{$hashed_password}', '{$firstname}', '{$lastname}', '{$gender}', '{$contactno}', '{$homecity}', '{$classtype}', '{$studenttype}');";
  
  #echo $sql;

  $response = mysqli_query($conn,$sql);

  $sql= "SELECT userid  FROM  users
  WHERE username ='{$username}' ;";

  $response = mysqli_query($conn,$sql);
 

  if($response){
      
    $row = mysqli_fetch_array($response);
    $userid= $row['userid'] ;
    
  }

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

  $sql="INSERT INTO users_districts( userid, districtid) VALUES {$link_sql1};";

  $response = mysqli_query($conn,$sql);

  $sql="INSERT INTO users_subjects ( userid, subjectid) VALUES {$link_sql2};";

  $response = mysqli_query($conn,$sql);

  $_SESSION['image_name']= $userid ;
  header("Location:imgupload.php");  

  }else{echo '<h1>Incorrect password</h1>';}  


 }


 mysqli_close($conn);
?>	
 <div class="container">
  <div class="box">
    <form action="Register.php" method="post">
  
    <h1>Register as a Teacher</h1>
    <br>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="firstname"><b>First Name</b></label>
    <input type="text" placeholder="Enter First Name" name="firstname" required>

    <label for="lastname"><b>Last Name</b></label>
    <input type="text" placeholder="Enter Last Name" name="lastname" required>

    <label for="email"><b>Email(User name)</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="email"><b>Contact number</b></label>
    <input type="text" placeholder="Enter Contact Number" name="contactno" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>


    <label for="gender"><b>Gender</b></label>
    <select name="gender" id="gender">
      <option value="female">Female</option>
      <option value="male">Male</option>
    </select>
  

    <label for="classtype"><b>Class Type</b></label>
    <select name="classtype" id="classtype">
      <option value="Individual">Individual</option>
      <option value="Group">Group</option>
      <option value="Both">Both</option>
    </select>


  <label for="studenttype"><b>Student Type</b></label>
    <select name="studenttype" id="studenttype">
      <option value="primary_level">Primary level</option>
      <option value="secondary_level">Secondary level</option>
      <option value="advanced_level">Advanced level</option>
    </select>
  

    <label for="homecity"><b>Home City</b></label>
    <input type="text" placeholder="Enter the name of your HomeCity" name="homecity" required>

    <label for="district"><b>Teaching Areas</b></label>

    <div class="checkbox_areas">

    <div class="checkbox_areas_sub">Colombo<input type="checkbox" name="district1" value='1' checked></div>
    <div class="checkbox_areas_sub">Kalutara<input type="checkbox" name="district2" value='2'></div>
    <div class="checkbox_areas_sub">Gampaha<input type="checkbox" name="district3" value='3'></div>
    <div class="checkbox_areas_sub">Galle<input type="checkbox" name="district4" value='4'></div>
    <div class="checkbox_areas_sub">Matara<input type="checkbox" name="district5" value='5'> </div>
    <div class="checkbox_areas_sub">Kurunagala<input type="checkbox" name="district6" value='6'></div>
    <div class="checkbox_areas_sub">Anuradhapura<input type="checkbox" name="district7" value='7'></div>
    <div class="checkbox_areas_sub">Polonnaruwa<input type="checkbox" name="district8" value='8'></div>
    <div class="checkbox_areas_sub">Jaffna<input type="checkbox" name="district9" value='9'></div>
    <div class="clr"></div>
    </div>

    <div class="clr"></div>
    
    <label for="Subjects"><b>Subjects</b></label>

    <div class="checkbox_areas">

    <div class="checkbox_areas_sub">Maths<input type="checkbox" name="subjects1" value='1' checked></div>
    <div class="checkbox_areas_sub">Science<input type="checkbox" name="subjects2" value='2'></div>
    <div class="checkbox_areas_sub">Sinhala<input type="checkbox" name="subjects3" value='3'></div>
    <div class="checkbox_areas_sub">Tamil<input type="checkbox" name="subjects4" value='4'></div>
    <div class="checkbox_areas_sub">English<input type="checkbox" name="subjects5" value='5'></div>
    <div class="checkbox_areas_sub">History<input type="checkbox" name="subjects6" value='6'></div>
    <div class="checkbox_areas_sub">Eastern music<input type="checkbox" name="subjects7" value='7'></div>
    <div class="checkbox_areas_sub">Western music<input type="checkbox" name="subjects8" value='8'></div>
    <div class="checkbox_areas_sub">Commerce <input type="checkbox" name="subjects9" value='9'></div>
    <div class="checkbox_areas_sub">A/L Combined Maths<input type="checkbox" name="subjects10" value='10'></div>
    <div class="checkbox_areas_sub">A/L Biology<input type="checkbox" name="subjects11" value='11'></div>
    <div class="checkbox_areas_sub">Geography<input type="checkbox" name="subjects12" value='12'></div>
    <div class="checkbox_areas_sub">A/L Computer science<input type="checkbox" name="subjects13" value='13'></div>
    
    </div>

    <hr>

    <script>
        function a(){
             alert("you are goining to upload a image");
        }
    </script>
    
    <button type="submit" class="registerbtn" name="submit"  onclick = "a()">Register</button>
  

</form>
</div>
</div>

</main>
<div class="empty_weight_forregister"></div>
<?php require_once('includes/footer.php'); ?>