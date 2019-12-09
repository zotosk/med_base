<?php
require '../dbconnect/dbconnect.php';

session_start();
if(ISSET($_POST["submit"]))  
  {
  if(empty($_POST["email"]) || empty($_POST["password"]))  
      {  
          $msg_empty_inputs = "Fields with '*' required";
      }
    }
     if (isset($_POST['email']) && isset($_POST['password'])){
      
        $email = $_POST['email'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $age = $_POST['age'];
        $p_job = $_POST['p_job'];
        $c_job = $_POST['c_job'];
        $looking_for = $_POST['looking_for'];
        $education_lvl = $_POST['education_lvl'];

        //CV upload for users - general files extensions
        $upload_cv_new = $_FILES['upload_cv']['name'];
        $upload_cv_new_temp = $_FILES['upload_cv']['tmp_name'];
        $upload_size = $_FILES['upload_cv']['size'];
        //uploads directory
        $upload_dir='../uploads_dir/';
        $imgExt=strtolower(pathinfo($upload_cv_new,PATHINFO_EXTENSION));
        $valid_extensions=array('jpeg', 'jpg', 'png', 'doc', 'docx');

        if(!in_array($imgExt,$valid_extensions) ) 
        { 
          $msg_alert = "Sorry, only JPG, JPEG, PNG ,DOC, DOCX  files are allowed.File not uploaded!";
        }else{
          $upload_cv=rand(1000, 1000000).".".$imgExt;
          move_uploaded_file($upload_cv_new_temp, $upload_dir.$upload_cv);
          //password encryption
          include_once '../hash_validation.php';

          // statement and query, check if email exists first.
          $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
          $stmt = $dbconnect->prepare($sql);
          
          //Bind email value
          $stmt->bindValue(':email', $email);
    
          $stmt->execute();
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          if($row['num'] > 0){
              die('This email already exists! Already registered? <a href="../login.php">Login</a>!');
          }
          //then insert, if the email does not exist
          $sql = "INSERT INTO `users` (email, password,first_name,last_name,age,p_job,c_job,looking_for,education_lvl,upload_cv) VALUES (:email, :password,'$first_name','$last_name','$age','$p_job','$c_job','$looking_for','$education_lvl' ,'$upload_cv')";
          $stmt = $dbconnect->prepare($sql);
          $stmt->bindValue(':email', $email);
          //Hash the password , so we do not store plain text passwords=>validation_hash.php
          $stmt->bindValue(':password', $passwordHash);
          $result = $stmt->execute();
          
        if($result)
        {
          $msg_success = "Registration Successful!" ;
          header("refresh:2;url= ../login.php"); 
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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Candid register</title>
  <script src="../js/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/uikit.min.css">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="../js/uikit.min.js"></script> 
  <script src='https://www.google.com/recaptcha/api.js'></script>
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
    var msg = "*Form accepts only letters,numbers(email-password exception)";
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
  //when copy-paste "space" ,return nothing
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
  
</head>

<body>
<header>  
  <div class="bard_top_nav"> 
    <ul class="social">
      <li>
          <a target="_blank" href="https://twitter.com/" title="twitter"><i class="fa fa-twitter"></i></a>
      </li>
      <li>
          <a target="_blank" href="https://facebook.com/" title="facebook"><i class="fa fa-facebook"></i></a>
      </li>
      <li>
          <a target="_blank" href="https://pinterest.com/" title="pinterest"><i class="fa fa-pinterest"></i></a>
      </li>
    </ul>
  </div>
</header>

<div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
    <div style="padding: 1.1rem">
        <img src="../img/candid.png" width="100px">
    </div>
    <nav class="uk-navbar uk-margin-large-bottom">
        <ul class="uk-navbar-nav uk-hidden-small">
            <li class="uk-active">
                <a href="../main_info.php">Home page</a>
            </li>
            <li>
                <a href="../login.php">Login</a>
            </li>
        </ul>
        <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
        <div class="uk-navbar-brand uk-navbar-center uk-visible-small"></div>
    </nav>

    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-1-1">
            <div class="uk-vertical-align uk-text-center">
                <h1 class="uk-heading-large">Register</h1>
                <p class="uk-text-large">Create your personal profile<br>and upload your CV.</p>           
            </div>
        </div>
    </div>

    <h2 class="uk-text-center">Create your account</h2>
    <hr class="uk-grid-divider">

    <div class="uk-grid" data-uk-grid-margin>
      <div class="uk-width-medium-1-1">
        <div class="uk-horizontal-align uk-text-center">
          <form class="uk-form uk-form-row" action="pdo_register.php" method="post"  enctype="multipart/form-data" autocomplete="off">
            <?php if(isset($msg_alert)){ ?><div class="uk-alert-danger2" role="alert"> <?php echo $msg_alert; ?> </div><?php } ?>
            <?php if(isset($msg_success)){ ?><div class="uk-alert-success2" role="alert"><?php echo $msg_success; ?>  <i class="uk-icon-spinner uk-icon-spin"></i></div><?php } ?>
                    <!-- <div class="form-group uk-margin">
                        <div>
                        <input type="text" class="form-input" name="username" id="username" placeholder="username"/>
                    </div> -->
                    <div class="form-group uk-margin">
                    <div id="lower-letters"></div>
                        <input type="text" class="uk-input uk-form-width-medium" onkeyup="lettersOnly(this)" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" required name="first_name" id="first_name" placeholder="* First Name"/>
                        
                    </div>
                    <div class="form-group uk-margin">
                        <input type="text" class="uk-input uk-form-width-medium" onkeyup="lettersOnly(this)" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" required name="last_name" id="last_name" placeholder="* Last Name"/>
                    </div>
                    
                    <div class="form-group uk-margin">
                        <input type="number" min="0" max="199" class="uk-input uk-form-width-medium" name="age" id="age" placeholder="Age"/>
                    </div>
                    <div class="form-group uk-margin">
                        <input type="email" class="uk-input uk-form-width-medium" required name="email" id="email" placeholder="* Your Email"/>
                    </div>
                    <div class="form-group uk-margin">
                        <input type="text" class="uk-input uk-form-width-medium" onkeyup="lettersOnly(this)" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" name="p_job" id="p_job" placeholder="Previous Job"/>
                    </div>
                    <div class="form-group uk-margin">
                        <input type="text" class="uk-input uk-form-width-medium" onkeyup="lettersOnly(this)" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" name="c_job" id="c_job" placeholder="Current Job"/>
                    </div>
                    <div class="form-group uk-margin">
                        <input type="text" class="uk-input uk-form-width-medium" onkeyup="lettersOnly(this)" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" required name="looking_for" id="looking_for" placeholder="* Looking For"/>
                    </div>
                    <div class="form-group uk-margin">
                        <input type="text" class="uk-input uk-form-width-medium" onkeyup="lettersOnly(this)" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" name="education_lvl" id="education_lvl" placeholder="Education Level"/>
                    </div>
                    <div class="form-group uk-margin">
                        <input type="password" class="uk-input uk-form-width-medium" required name="password" id="password" placeholder="* Password"/>
                    </div>
                    <!-- <div class="form-group uk-margin">
                        <input type="password" class="uk-input uk-form-width-medium" name="re_password" id="re_password" placeholder="Repeat your password"/>
                    </div> -->
                    <div class="form-group uk-margin">
                      <label for="new_image" id="upload_input">Upload your CV: (  Max 2mb ) </label>
                      <input type="file" class="uk-input uk-form-width-medium" name="upload_cv">
                    </div>

                    <div class="form-group uk-margin">
                        <input type="checkbox" class="uk-checkbox" name="agree-term" id="agree-term" class="agree-term" />
                        <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                    </div>
                    
                    <?php if(isset($msg_alert)){ ?><div class="uk-alert-danger2" role="alert"> <?php echo $msg_alert; ?> </div><?php } ?>
                    <?php if(isset($msg_success)){ ?><div class="uk-alert-success2" role="alert"><?php echo $msg_success; ?>  <i class="uk-icon-spinner uk-icon-spin"></i></div><?php } ?>
                    <?php if(isset($msg_empty_inputs)){ ?><div class="uk-alert-danger2" role="alert"> <?php echo $msg_empty_inputs; ?> </div><?php } ?>
      
                    <div class="form-group uk-margin">
                      <input type="submit" class = "uk-button uk-button-primary uk-button-large" name="submit" id="submit" value="Submit" style="color: #fff;letter-spacing: 0.6;font-size:1.3rem;"/>
                    </div> 
                    <!-- RECAPTCHA -->
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
          </form>  
          <!-- ####### footer -->
          <div class="uk-form-row" >
            <div class="uk-card uk-card-default uk-card-body uk-margin">
              <p class="loginhere uk-margin">
              Have already an account ? <a href="../logout.php" class="login">Login here</a>
              </p>
            </div>          
            <div class="uk-card uk-card-default uk-card-body">
              <a href="https://eugdprcompliant.com/">GDPR</a>&nbsp;&nbsp;&nbsp;<a href="">FAQ</a>&nbsp;&nbsp;&nbsp;<a href="../login.php">HOME</a>
            </div>
          </div>
      </div>
    </div>
  </div>
      <div id="offcanvas" class="uk-offcanvas">
        <div class="uk-offcanvas-bar">
          <ul class="uk-nav uk-nav-offcanvas">
              <li class="uk-active">
                  <a href="../main_info.php">Home</a>
              </li>
              <li>
                  <a href="#">FAQ</a>
              </li>
              <li>
                  <a href="../contact_us.php">Contact us</a>
              </li>
              <li>
                  <a href="../login.php">Login</a>
              </li>
          </ul>
        </div>
      </div>
</body>
</html>