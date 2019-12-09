<?php

require './db/connection.php';
//require_once './recaptcha/recaptcha_verify.php';
session_start();
  
if (!$dbconnect){
    die("Database Connection Failed" . errorInfo($dbconnect));
}

$select_db = define('MYSQL_DATABASE','test');
if (!$select_db){
    die("Database Selection Failed" . errorInfo($dbconnect));
}
//*__________________________________________________________________*//
    
  if(isset($_POST['submit']))
  { 
    $username = $_POST['username']; 
    //$password = $_POST['password'];
    $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $age = $_POST['age'];
        $birth = $_POST['birth'];
    
    if(empty($_POST["username"]) || empty($_POST["password"]))  
    {  
      $errormsg = '<label>*All fields are required!</label>';  
    }
  }
  //Check Username if already exsists inside the Database
  // $query_db = "SELECT * FROM `members` WHERE username = '$username' ";
  // $statement = $dbconnect->prepare($query) or die("Unexpected error.Query failed");

  $query_db = "SELECT COUNT(username) AS num FROM members WHERE username = :username";
  $stmt = $dbconnect->prepare($query_db);
  
  $stmt->bindValue(':username', $username);
  
  //Execute.
  $stmt->execute();
  
  //Fetch
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if($row['num'] > 0)
  {
    die('That username already exists!Try another');
  }

  if (isset($_POST['submit'])) 
  {

    //trim for empty input or spaces
    if(trim($_POST['password']) == "" || trim($_POST['confirm_password']) == "")
    {
      $errormsg = '<label>*Empty inputs.All fields are required!</label>';
    }
    //password dont match with the confirm_password input
    else if($_POST['password'] != $_POST['confirm_password'])
    {
      $confirmerror = "*Your password is not the same.Please try again!";     
    }

   //check if password is the same with the confirm_password input
    else if($_POST['password'] == $_POST['confirm_password'] && !empty($_POST['username']) && $query_db = true )
    {

      //$hash = password_hash($password,PASSWORD_BCRYPT);// array("cost" => 10)); // have to fix encryption CANOT LOGIN
      // $password = $_POST['password'];
      // $username = $_POST['username'];

        

     $hash_pass = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
      //$email = $_POST['email'];
         //Bind our variables.
      // $stmt->bindValue('username', $username);
      // $stmt->bindValue('password', $hash);

      $query_db = "INSERT INTO members (username, password, firstname, lastname, email, age) VALUES ('$username', '$hash_pass', '$firstname', '$lastname', '$email', 'age')";
      $stmt = $dbconnect->prepare($query_db);

      $result = $stmt->execute();

      if($result)
      {
        $smsg = "<strong>Registration successful !</strong> Redirecting to the login page..";
        header("refresh:5;url=pdo_login.php"); 
      }
      else{
        echo 'Query failed!';
      }
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MDB REGISTER|HEALTH PORTAL</title>
  <link href="http://fonts.googleapis.com/css?family=Raleway:400,300,700" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style> @media screen and (max-height: 575px){ 
  #resize-recaptcha, .g-recaptcha {
    transform:scale(0.77);
    -webkit-transform:scale(0.77);
    transform-origin:0 0;
    -webkit-transform-origin:0 0;
    } 
  } 
  </style> 
  <script>
  //Regex on register, removes symbols ,(accepts only letters,numbers)
  function lettersOnly(input){
    var msg = "*Accepts only letters,numbers";
    var lowerLetters = document.getElementById('lower-letters').innerHTML = msg;
    var regex = /[^A-Za-z0-9\\s]/g;
  
    input.value = input.value.replace(regex,"");
  }
  </script>
  <script>
    //on keypress (spacebar keyCode) , return nothing
  $(document).on("keypress", function (event){
    var codePressed = event.which;
    if (codePressed == 32) {
       //this.value = this.value.replace(/\s/g, "");
      return false; // return nothing while spacebar is pressed
    }
  });
  //when copy-paste space ,return nothing
  $(document).ready(function() {
    $('#password').bind("cut copy paste", function(e) {
        e.preventDefault();
        $('#password').bind("contextmenu", function(e) {
            e.preventDefault();
        });
    });
  });
  //disable all copy-paste from all inputs
  $(document).ready(function () {
      $('input[type=text]').bind('copy paste', function (e) {
         e.preventDefault();
      });
   });
  </script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css" />
   -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
  <!--<link rel="icon" type="image/x-icon" href="favicon.ico">-->
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
  <div class="container">
    <img src="img/mdb-logo.gif">
    <!--<h1 class="brand"><span>MEDBASE</span> HEALTH PORTAL (MBD)</h1>-->
    <div class="wrapper animated bounceInLeft">
      <div class="company-info">
        <div class="navbar">
          <ul class="nav-menu">
            <li><a href="pdo_login.php">Home</a></li>
            <li><a href="">FAQ</a></li>
            <li><a href="">About</a></li>
            <li><a href="">Contact Us</a></li>
          </ul>
        </div>
        <h2>patient portal</h2>
        <ul>
          <li><i class="fas fa-location-arrow"></i> (HQ)33 St. Silicon Valley</li>
          <li><i class="fas fa-phone"></i> (123) 123-45678910</li>
          <li><i class="fas fa-envelope"></i> support@medbase.com</li>
        </ul>
      </div>
      <div class="login">
        <h3>Registration Form
          <span style="opacity: 0.5;">(* Please fill in your personal information below )</span>
        </h3>
          <strong>All information required to create your own personal medical profile and be able to login</strong>
        <p>
          <?php if(isset($smsg)){ ?>
            <div class="alertbg">
              <div class="alert alert-success greenbg" role="alert">
                 <i class="fas fa-check"></i>
                <?php echo $smsg; ?>    
              </div>
            </div>
          <?php } ?>
        </p>

        <form method="POST" action="pdo_register.php" autocomplete="off" class="reCaptcha">
          <p>
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname">
          </p>
          <p>
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname">
          </p>
          <p>
            <label for="birth">Date of Birth</label>
            <input type="date" name="birth" id="birth">
          </p>
          <p>
            <label for="age">Age</label>
            <input type="text" name="age" id="age">
          </p>
          <p>
            <label for="email">Your E-mail</label>
            <input type="email" name="email" id="email">
          </p>
          <p>
            <label for="username">username</label>
            <input type="text" name="username" id="username" autocomplete="off" onkeyup="lettersOnly(this)" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" required="required">
            <span id="lower-letters"></span>
            <?php if(isset($errorname)){ ?> 
              <div class="alert alert-danger" role="alert"> 
                <?php echo $errorname; ?> 
              </div>
            <?php } ?>
          </p>

          <p>
            <label for="password">password</label>
            <input type="password" name="password" id="password" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" required="required">

            <label for="confirm_password">confirm password</label>
            <input type="password" name="confirm_password" id="confirm_password" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" required="required">
          </p>
          
          <p>
            <!-- Recaptcha Validation -->
            <small>Please verify that you are not a bot</small>
            <!-- check if user clicks the captcha checkbox , and print it in console -->
            <script>
            var recaptchaOnClick = function(){
              console.log("Captcha clicked");
            };
            </script>
  
           <div class="g-recaptcha" id="resize-recaptcha" data-sitekey="6LczemkUAAAAAAW_VUv6MgPvVCsAnoIHhNqJR0Ao" data-callback="recaptchaOnClick" ></div>
            <?php if(isset($captchaFail)){ ?>
            <div class="alert alert-danger" role="alert">
             <?php echo $captchaFail; ?> 
            </div><?php } ?>
          </p>

          <p class="full">
            <input type="submit" name="submit" value="submit" id="submit">
          </p>

          <?php if(isset($confirmerror)){ ?>
            <div class="alert alert-danger" role="alert">
             <?php echo $confirmerror; ?> 
            </div><?php } ?>

          <?php if(isset($fmsg)){ ?>
            <div class="alert alert-danger" role="alert"> 
              <?php echo $fmsg; ?> 
            </div>
          <?php } ?>

          <?php if(isset($errormsg)){ ?>
            <div class="alert alert-danger" role="alert"> 
              <?php echo $errormsg; ?> 
            </div>
          <?php } ?>
        </form>
      </div>
        <p>Already have a personal account? Login 
          <a href="pdo_login.php">here</a>
        </p>
      </div>
    </div>
  </div>
</body>
</html>