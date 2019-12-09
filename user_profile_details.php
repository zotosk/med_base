<?php
require 'dbconnect/dbconnect.php';
session_start();  

if(isset($_SESSION["email"]))
{  
   $sql = "SELECT * FROM users WHERE email = '" . $_SESSION['email'] . "'";
   $statement = $dbconnect->query($sql);  
   $row = $statement->fetch(PDO::FETCH_ASSOC);    
} 

?>