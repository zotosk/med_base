<?php  
//login_success.php  
require 'dbconnect/dbconnect.php';
session_start();

if(isset($_SESSION["username"]))
{  
	$success_user = '<b> '.$_SESSION["username"].'</b>';
}  
else  
{  
	header("location:pdo_login.php");  
} 

$sql_query = "SELECT * FROM `users`";//WHERE username='$username'";
	$stmt = $dbconnect->prepare($sql_query);
	$query = $dbconnect ->query($sql_query);
	$stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //Execute.
   
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>MEDBASE|HEALTH PORTAL</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="css/normalize.css">
	<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
   <style type="text/css">

#profile-wrapper{
	width: auto;
	background: #EBEBEB;
	padding: 2em;
	border: 1px solid grey;
}

	#user-profile {
		padding-top: 2em;
	}
	    		#user-profile span {
	    			line-height: 2;
	    		}
	    	</style>

</head>
<body>
	<div class="container">
	    <img src="img/mdb-logo.gif">
	    <!--<h1 class="brand"><span>MEDBASE</span> HEALTH PORTAL (MBD)</h1>-->
		<div class="wrapper animated bounceInLeft">
			<div class="company-info">
	        	<div class="navbar">
	          		<ul class="nav-menu grid-container">
				      	<li><a href="">My Medical Profile</a></li>
				        <li><a href="pdo_login.php">Home</a></li>
				        <li><a href="">FAQ</a></li>
				        <li><a href="">About</a></li>
				        <li><a href="">Contact Us</a></li>
				        <span class="display-user">
							<?php if(isset($success_user)){ ?>
								<div class="user-login" role=""> 
								Welcome,	<?php echo $success_user; ?><button style="margin-left: 1.4em;"><a href="logout.php">Logout</a></button>
								</div>
							<?php } ?>
						</span>
	          		</ul>
	          	</div>
			</div>
	    </div>
	 
	    <section id="user-profile">
	    	<div id="profile-wrapper">
				<p>			
					Welcome user <?php echo $success_user; ?>, here you can view,edit,delete any personal detail from your profile.
				</p>
				<!-- user profile details -->
				<br>
				<span>
					<button>Edit Profile</button>
				</span>
				<p></p>
				<span>
					 <img src="img/user-default-image.png">
					<?php
						if ($row['firstname']){
					?>   
					<br>
						First Name : <?php echo $row['firstname'];?>
					
						<?php } ?>
				</span>
				<span>
					<?php
						if ($row['lastname']){
					?>   
					<br>
						Last Name : <?php echo $row['lastname'];?>
					
						<?php } ?>
				</span>
				<span>
					<?php
						if ($row['age']){
					?>   
					<br>
						Age : <?php echo $row['age'];?>
					
						<?php } ?>
				</span>
				<span>
					<?php
						if ($row['email']){
					?>   
					<br>
						E-mail : <?php echo $row['email'];?>
					
						<?php } ?>
				</span>
			</div>
	    </section>
	 </div>
</body>
</html>