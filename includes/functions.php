<?php
function similler_row_check($response){ 
if($response){
// to check the rows that has same user id. because subjects and districts not shown in one row
$similler_row_check= array('userid' =>'');
$subject_name_array = array();
$district_name_array = array();
$all_records = array();
$increment = 1;

while($row = mysqli_fetch_array($response)){
if($increment==1){
// this is for 1 st round
$subject_name_array[]=$row['subject_name'];
$district_name_array[]=$row['district_name'];
//for remove duplicants
$subject_name_array=array_unique($subject_name_array);
$district_name_array=array_unique($district_name_array);
}
else if($row['userid']==$similler_row_check['userid']){
// if next rows's user id is same as previous then subjects,and districts are combine into two arrays
$subject_name_array[]=$row['subject_name'];
$district_name_array[]=$row['district_name'];
$subject_name_array=array_unique($subject_name_array);
$district_name_array=array_unique($district_name_array);
$a = array('userid' =>$row['userid'] , 'firstname'=>$row['firstname'], 'lastname'=>$row['lastname'], 'gender'=>$row['gender'], 'contactno'=>$row['contactno'], 'homecity'=>$row['homecity'], 'classtype'=>$row['classtype'], 'studenttype'=>$row['studenttype'],'subjects' =>$subject_name_array ,'districts' => $district_name_array );

}
else if( ($row['userid']!=$similler_row_check['userid'])and($increment!=1)  ){
// jump into next postion of the array and save into all_records
$all_records[] = $a ;
$subject_name_array  = array();
$district_name_array = array();
$subject_name_array[]=$row['subject_name'];
$district_name_array[]=$row['district_name'];
$subject_name_array=array_unique($subject_name_array);
$district_name_array=array_unique($district_name_array);
$a = array('userid' =>$row['userid'] , 'firstname'=>$row['firstname'], 'lastname'=>$row['lastname'], 'gender'=>$row['gender'], 'contactno'=>$row['contactno'], 'homecity'=>$row['homecity'], 'classtype'=>$row['classtype'], 'studenttype'=>$row['studenttype'],'subjects' =>$subject_name_array ,'districts' => $district_name_array );
}


$similler_row_check['userid'] = $row['userid'];
$increment += 1;

}
if(isset($a)){
$all_records[] = $a ;
}
else{
	echo "No Records";
}
}else{
	echo 'Something Wrong.... bro';

}
	return $all_records;
}

?>