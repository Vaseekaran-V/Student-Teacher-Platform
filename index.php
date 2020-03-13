<?php require_once('includes/header_home.php'); ?>
<?php session_start();

	$_GET = array();
	    $_SESSION = array();
	   
	    if (isset($_COOKIE[session_name()])){
	      setcookie(session_name(),'',time()-86400,'/');
	    }

	    session_destroy();?>

	    
<main>
	<br>
	<br>
    	<h1 id="heading">FINDING YOU THE RIGHT TEACHER</h1>
    	<br>
    	<br>
    	<div class = "intro">
        	<ul>
            	<br>
            	<li>For many students, around the country, in both rural and metropolitan areas, the issue they have to overcome is <span>finding the correct teacher for their relevant subjects.</span> </li>
            	<br>
            	<li>Our new LAS (Learning Assistance System) bridges the gap between Students and Teachers</li>
            	<br>
        	</ul>
		</div>
		<br><br>
 
    	<div class="targets">
			<h1 class="objectives_heading">Our Objectives</h1>
			<br>
        	<div class="objectives">
            	<br>
            	<ul>
                	<li>To register talented teachers and instructors to our system, from various regions.</li>
                	<br>
                	<li>To create an easy interface for the students to use the system.</li>
                	<br>
                	<li>To enable the students to access information about teachers and their relevant subjects.</li>
                	<br>
            	</ul>
        	</div>
		</div>
		<br><br>

    	<div class="features">
			<h1 class="features_heading">Features of this Site</h1>
			<br>
        	<div class="features_content">
                	<br>
            	<ul>
                	<li>Any interested teacher can register to the system, giving details such as their region, credentials, etc.</li>
                	<br>
                	<li>Any student wanting to find a suitable teacher in their region, can search for the teacher with respect to subject, region, grade or type of class.</li>
                	<br>
            	</ul>
			</div>

		</div>
		<br><br>
</main>

<?php require_once('includes/footer.php'); ?>