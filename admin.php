<?php session_start();?>
<?php require_once('includes/header.php'); ?>
<?php require_once('includes/conn.php');?>
<?php require_once('includes/functions.php');?>
<?php if(!isset($_SESSION['adminuserid'])){

  header('Location:index.php');
}
?>

<?php

        

    $sql = "SELECT users.userid,users.firstname,users.lastname,users.gender,users.contactno,users.homecity,users.classtype,users.studenttype,subjects.subject_name,districts.district_name
    FROM users 
    JOIN users_subjects
    ON users_subjects.userid = users.userid 
    JOIN subjects 
    ON users_subjects.subjectid = subjects.subjectid
    JOIN users_districts
    ON users_districts.userid = users.userid
    JOIN districts
    ON users_districts.districtid = districts.districtid ORDER BY users.userid;";

    /*
    echo '<br>';
    echo $sql;
    */
    $response = mysqli_query($conn,$sql);

    $all_records=similler_row_check($response);
    
    $_GET = array();
    $_SESSION = array();
   
    if (isset($_COOKIE[session_name()])){
      setcookie(session_name(),'',time()-86400,'/');
    }

    session_destroy();

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
      echo '<td> <a href = "view_profile.php?sql_link='.'&record='.$x.'&">View Profile</a> </td>';
      echo '<td> <a href ="Delete_user_2.php?deluser='.$all_records[$x]['userid'].'" > Delete the account</a></td>';
       
      echo "</tr>";
    }
    echo'</table>';
    mysqli_close($conn);


    
 ?>