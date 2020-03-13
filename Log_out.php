<?php
session_start();
$_SESSION = array();
/* '/' means  it affect root folder of this website */
if (isset($_COOKIE[session_name()])){
	setcookie(session_name(),'',time()-86400,'/');
}

session_destroy();
header('Location:Login.php?logout=yes');



?>