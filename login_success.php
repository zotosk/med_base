<?php
require 'dbconnect/dbconnect.php';

session_start();  
   
if(isset($_SESSION["email"]))
{  
   echo '<h3>Login Success, Welcome - '.$_SESSION["email"].'</h3>';

   header("refresh:2; url=user_profile.php");
}

?>