<?php
require 'dbconnect/dbconnect.php';
session_start();
try  
{
  if(ISSET($_POST["submit"]))  
  {    
    $email = $_POST['email'];
    $password = $_POST['password'];

    

     if(empty($_POST["email"]) || empty($_POST["password"]))  
     {  
        $msg_empty_inputs = "*All fields required";
     }
     else  
     {     
      $dbquery = "SELECT * FROM `users` where email = ? and password = ?";
      $statement = $dbconnect->prepare($dbquery);  
      
      include_once 'hash_validation.php';

      $statement->execute(  
      array($_POST["email"],$passwordHash));
      
      $count = $statement->rowCount(); 
        if($count > 0 ) 
        {  
          $_SESSION["email"] = $email;
          $msg_success="&#10004;  Login successful ! ";  
          header("refresh:3; url=login_success.php");        
        }
        else
        {  
          $msg_alert="*Incorrect email or password!";         
      }
    }
  }
}
 catch(PDOException $msg_error)  
 {  
      $error = $msg_error->getMessage();  
 };
?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr" class="uk-height-1-1">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Candid login</title>
  <script src="js/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="css/uikit.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
  <script src="js/uikit.min.js"></script>
</head>

<body class="uk-height-1-1">    
<header>
  <div class="bard_top_nav">
    <ul class="social">
      <li>
        <a target="" href="https://twitter.com/" title="twitter"><i class="fa fa-twitter"></i></a>
      </li>
      <li>
        <a target="" href="https://facebook.com/" title="facebook"><i class="fa fa-facebook"></i></a>
      </li>
      <li>
        <a target="" href="https://pinterest.com/" title="pinterest"><i class="fa fa-pinterest"></i></a>
      </li>
    </ul>
  </div>
  <div id="bard_top_main_menu">
    <ul class="social">
      <li>
        <a target="" href="main_info.php" class="color">Home</a>
      </li>
      <li>
        <a target="" href="user_profile_register/pdo_register.php" class="color">Register</a>
      </li>
      <li>
        <a target="" href="contact_us.php" class="color">Contact us</a>
      </li>
    </ul>
  </div>
</header>
<div class="uk-vertical-align uk-text-center">     
  <div class="uk-vertical-align-middle"> 
    <div class="wrapper_head">
      <!-- ### search bar - ( serach a candidate skill ) -->
    <script>
      function formValidation(){
        if(!!document.querySelector('#search').value)
        {
          return true;
        }else{          
          document.getElementById("search_error").innerHTML = "*Empty search input!"; 
          return false;
          }
        }       

      </script>
      
      <form class="uk-search uk-search-default" method="GET" action="see_candidates.php" onsubmit="return formValidation()">
        <div style="padding:20px;">
          <p class="find_candidate" style="">Find your candidate</p>
          <div class="msg">
            <p>Keep growing your business, find the right person you are looking for easy and fast..</p>
          </div>
        </div>
        <div class="wrap_search_bar">
          <!-- search Button -->              
            <input class="uk-search-input search-bar" id="search" autocomplete="off" name="search_bar" type="search" placeholder="Search a candidate skill..">
            <button class="uk-icon-medium uk-icon-chevron-right __custome_size_search__arrow" type="submit"></button>
            <span class="_msg_below_search_bar">No sign up required.Browse for free..</span>
            <span id="search_error"></span>
            <div id="foo"></div>
       
        </div>
      </form>
    </div>
    <div class="wrap_we_make_it">
      <h2 class="welcome_msg">Welcome to Cand<b>id</b>.</h2>
      <div class="we_make_it">We help you find new job opportunities!<br>
        <span class="we_make_it">We make it happen. &nbsp;<i class="uk-icon-thumbs-o-up size_custome"></i></span>
      </div>
    </div>
    <img class="uk-margin-top uk-margin-bottom" width="140" src="img/candid.png" title="candid logo">
      <!-- ### Login form -->
      <form class="uk-panel uk-panel-box uk-form" method="POST">

          <div class="uk-form-row">
            <li class="uk-icon-user icon_position"></li>
            <input class="uk-width-1-1 uk-form-large" type="text" placeholder="Email" name="email" required>
          </div>

          <div class="uk-form-row">
          <li class="uk-icon-lock icon_position_lock"></li>
            <input class="uk-width-1-1 uk-form-large" type="password" placeholder="Password" name="password" required >
          </div>
          <!--Remeber me + Forgot password -->
          <div class="uk-form-row uk-text-small">
            <span class="rembember_me">Remember me</span>  
              <label class="container">                            
                <input type="checkbox" type="checkbox">
                <span class="checkmark"></span>
              </label>
              <a class="uk-float-right uk-link uk-link-muted" href="#"><u>Forgot Password ?</u></a><br>
              <a class="uk-float-right uk-link uk-link-muted" href="user_profile_register/pdo_register.php"><u> New to Candid ? Join us</u></a></a>
          </div>

          <div class="uk-form-row" >
            <input type="submit" class="uk-width-1-1 uk-button uk-button-primary uk-button-large" name="submit" value="Sign in" style="color: #fff;letter-spacing: 0.6;font-size:1.3rem;"> 
            <?php if(isset($msg_alert)){ ?><div class="uk-alert-danger" role="alert"> <?php echo $msg_alert; ?> </div><?php } ?>
            <?php if(isset($msg_success)){ ?><div class="uk-alert-success" role="alert"><?php echo $msg_success; ?>  <i class="uk-icon-spinner uk-icon-spin"></i></div><?php } ?>
            <?php if(isset($msg_empty_inputs)){ ?><div class="uk-alert-danger" role="alert"> <?php echo $msg_empty_inputs; ?> </div><?php } ?>
          </div>
      </form>
      
      <div class="uk-panel uk-panel-box">
        <span>Candid 2019.&copy; All rights reserved.</span>
      </div>
      <hr>
      <footer class="uk-panel uk-panel-box">
      <span>City Unity College 2019
        CIS 5006 - Konstantinos Zotos</span>
      </footer>
    </div>
  </div>
</div>
</body>
</html>