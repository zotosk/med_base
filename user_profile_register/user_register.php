<?php
require '../dbconnect/dbconnect.php';

session_start();
if(ISSET($_POST["submit"]))  
  {
    if(trim($_POST['amka']) == "" || trim($_POST['email']) == "" || trim($_POST['first_name']) == "" || trim($_POST['password']) == "" || trim($_POST['last_name']) == "" )
    {
      $msg_empty_inputs = "<div>Empty inputs. All fields required !</div>";
    } 
    else
    { 

        $email = $_POST['email'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $amka = $_POST['amka'];
        
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
            die('This email and AMKA exists! Already registered ? <a href="../index.php">Please Login</a>!');
        }
        //then insert, if the email does not exist
        $sql = "INSERT INTO `users` (email, password,first_name,last_name) VALUES (:email, :password,'$first_name','$last_name')";
        $stmt = $dbconnect->prepare($sql);
        $stmt->bindValue(':email', $email);
        //Encrypt(md5) the users passwords , so we do not store plain text passwords=>hash_validation.php
        $stmt->bindValue(':password', $passwordHash);
        $result = $stmt->execute();
          
        if($result)
        {
          $msg_success = "Your registration was successful. Please login with your AMKA and password." ;
          header("refresh:3;url= ../index.php"); 
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
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  
  <!-- Site Properties -->
  <title>medbase|register</title>
  <link rel="stylesheet" type="text/css" href="../semantic/components/reset.css">
  <link rel="stylesheet" type="text/css" href="../semantic/components/site.css">

  <link rel="stylesheet" type="text/css" href="../semantic/components/container.css">
  <link rel="stylesheet" type="text/css" href="../semantic/components/grid.css">
  <link rel="stylesheet" type="text/css" href="../semantic/components/header.css">
  <link rel="stylesheet" type="text/css" href="../semantic/components/image.css">
  <link rel="stylesheet" type="text/css" href="../semantic/components/menu.css">
  <link rel="stylesheet" type="text/css" href="../semantic/components/input.css">
  <link rel="stylesheet" type="text/css" href="../semantic/components/checkbox.css">
  <link rel="stylesheet" type="text/css" href="../semantic/components/form.css">
  <!-- <link rel="stylesheet" type="text/css" href="../semantic/components/form.js"> -->
  <link rel="stylesheet" type="text/css" href="../semantic/components/message.css">

  <link rel="stylesheet" type="text/css" href="../semantic/components/divider.css">
  <link rel="stylesheet" type="text/css" href="../semantic/components/dropdown.css">
  <link rel="stylesheet" type="text/css" href="../semantic/components/segment.css">
  <link rel="stylesheet" type="text/css" href="../semantic/components/button.css">
  <link rel="stylesheet" type="text/css" href="../semantic/components/list.css">
  <link rel="stylesheet" type="text/css" href="../semantic/components/icon.css">
  <link rel="stylesheet" type="text/css" href="../semantic/components/sidebar.css">
  <link rel="stylesheet" type="text/css" href="../semantic/components/transition.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">

  <style type="text/css">

    progress[value]{
      -webkit-appearance: none;
      appearance: none;
    }

    progress[value]::-webkit-progress-bar {
      background-color: #eee;
      border-radius: 2px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.25) inset;
    }

    .hidden.menu {
      display: none;
    }

    .error {
      color: red;
      font-size: 90%;
    }

    .bg-img{
      /* background-image: url('img/bg.jpg') !important; */
      background: #F3F4F5;
      /* background-size: cover !important; */
      color: rgba(29, 26, 26, 0.9);
    }

    .masthead.segment {
      min-height: 700px;
      padding: 1em 0em;
    }

    .masthead .logo.item img {
      margin-right: 1em;
    }

    .masthead .ui.menu .ui.button {
      margin-left: 0.5em;
    }

    .masthead h1.ui.header {
      margin-top: 1em;
      margin-bottom: 0em;
      font-size: 3em;
      font-weight: bold;
      color: rgb(23, 62, 145);
    }

    .masthead h2 {
      font-size: 1.4em;
      margin: 0.58em 0 1.2em 0;
      font-weight: normal;
      color: rgba(62, 94, 158, 0.527);
    }

    h2.bolder-font{
      font-size: 2.5em !important;
      font-weight: bolder;
    }

    .padding{
      padding : 1.2em;
      background: rgba(0,0,0,0.04);
      border-radius: 5px;
    }

    .ui.vertical.stripe {
      padding: 8em 0em;
    }

    .ui.vertical.stripe h3 {
      font-size: 2em;
    }

    .ui.vertical.stripe .button + h3,
    .ui.vertical.stripe p + h3 {
      margin-top: 3em;
    }

    .ui.vertical.stripe .floated.image {
      clear: both;
    }

    .ui.vertical.stripe p {
      font-size: 1.33em;
    }

    .ui.vertical.stripe .horizontal.divider {
      margin: 3em 0em;
    }

    .left-aligned-container{
      text-align: left;
    }

    .quote.stripe.segment {
      padding: 0em;
    }

    .quote.stripe.segment .grid .column {
      padding-top: 5em;
      padding-bottom: 5em;
    }

    .footer.segment {
      padding: 5em 0em;
    }

    .secondary.pointing.menu .toc.item {
      display: none;
    }

    @media only screen and (max-width: 700px) {
      .ui.fixed.menu {
        display: none !important;
      }

      h2.bolder-font{
        font-size: 1.2em !important;
      }

      .secondary.pointing.menu .item,
      .secondary.pointing.menu .menu {
        display: none;
      }

      .secondary.pointing.menu .toc.item {
        display: block;
      }

      .masthead.segment {
        min-height: 350px;
      }

      .masthead h1.ui.header {
        font-size: 2em;
        margin-top: 1.5em;
      }

      .masthead h2 {
        margin-top: 0.5em;
        font-size: 1.5em;
      }
    }
  </style>

  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../semantic/components/visibility.js"></script>
  <script src="../semantic/components/sidebar.js"></script>
  <script src="../semantic/components/transition.js"></script>
  <script src="../semantic/components/dropdown.js"></script>
  <script>
  $(document)
    .ready(function() {

      // fix menu when passed
      $('.masthead')
        .visibility({
          once: false,
          onBottomPassed: function() {
            $('.fixed.menu').transition('fade in');
          },
          onBottomPassedReverse: function() {
            $('.fixed.menu').transition('fade out');
          }
        })
      ;

      // create sidebar and attach to menu open
      $('.ui.sidebar')
        .sidebar('attach events', '.toc.item')
      ;
    })
  ;

  </script>
  <script>

  //Regex on register, removes symbols ,(accepts only letters,numbers)
  function lettersOnly(input){
    // var msg = "";
    // var lowerLetters = document.getElementById('lower-letters').innerHTML = msg;
    var regex = /[^A-Za-z0-9\\s]/g;
    input.value = input.value.replace(regex,"");
  };

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
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>

<!-- Following Menu -->
<div class="ui large top fixed hidden menu">
  <div class="ui container">
    <a class="active item">Home</a>
    <a class="item">Work</a>
    <a class="item">Company</a>
    <a class="item">Careers</a>
    <div class="right menu">
      <div class="item">
        <a class="ui button">Log in</a>
      </div>
      <div class="item">
        <a class="ui primary button">Sign Up</a>
      </div>
    </div>
  </div>
</div>

<!-- Sidebar Menu -->
<div class="ui vertical inverted sidebar menu">
  <a class="item">Home</a>
  <a class="item">About</a>
  <a class="item">FAQ</a>
  <a class="item">Contact us</a>
  <a class="item">Login</a>
  <a class="item">Signup</a>
</div>


<!-- Page Contents -->
<div class="pusher">
  <div class="ui inverted vertical masthead center aligned segment bg-img">
    <div class="ui container">
      <div class="ui large secondary inverted pointing menu">
        <a class="toc item" style="text-decoration:none;">
          <i class="sidebar icon"></i>
        </a>
        <a class="item" href="../index.php" style="padding-left:0px;">Home</a>
        <div class="right item">
          <a class="medium ui button" href="../index.php">Log in</a>
        </div>
      </div>
    </div>
<script>
// -- FORM VALIDATION --
//user test() method from regex yo validate and also printing any errors
//we prevent submit the form if any errors or empty inputs occure

function printError(elemId, hintMsg) {
  document.getElementById(elemId).innerHTML = hintMsg;
}

function validateForm() {
  
  var firstName = document.form.first_name.value;
  var lastName = document.form.last_name.value;
  var dob = document.form.dob.value;
  var amka = document.form.amka.value;
  var email = document.form.email.value;
  var password = document.form.password.value;
  var response = grecaptcha.getResponse().length;

    var firstErr = true;
    var lastErr = true;
    var dobErr = true;
    var amkaErr = true;
    var emailErr = true;
    var passErr = true;
    var captchaErr = true;

    if(!firstName) {
      printError("firstErr", "Please enter your first name");
  } else {
      var regex = /^[a-zA-Z\s]+$/;                
      if(regex.test(firstName) === false) {
          printError("firstErr", "Please enter a valid name");
      } else {
          printError("firstErr", "");
          firstErr = false;
      }
  }

  if(!lastName) {
      printError("lastErr", "Please enter your last name");
  } else {
      var regex = /^[a-zA-Z\s]+$/;                
      if(regex.test(lastName) === false) {
          printError("lastErr", "Please enter a valid name");
      } else {
          printError("lastErr", "");
          lastErr = false;
      }
  }

  if ( !Date.parse(dob) ){ 
    printError("dobErr", "Please select your date of birth");     
  }
  else{
    printError("dobErr", "");
    dobErr = false;    
  }


  if(!amka) {
    printError("amkaErr", "Please enter your AMKA");
    } else {
        var regex = /^(\d{11})+$/;                
        if(regex.test(amka) === false) {
            printError("amkaErr", "Please enter a valid AMKA");
    } else {
            printError("amkaErr", "");
            amkaErr = false;
    }
  }

  if(!email) {
    printError("emailErr", "Please enter your email address");
    } else {
    // Regular expression for basic email validation
    var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(regex.test(email) === false) {
        printError("emailErr", "Please enter a valid email address"); 
        document.getElementById("email").style.border = "1px solid red";
    } else{
        printError("emailErr", "");          
        document.getElementById("email").style.border = "1px solid green";
        emailErr = false;
    }
  }

  if(!password) {
    printError("passErr", "Please enter your password");
  } else {
    // Regular expression for basic email validation
    var regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    if(regex.test(password) === false) {
        printError("passErr", "Please enter a valid password");
    } else{
        printError("passErr", "");
        passErr = false;
    }
  }

  //reCaptcha validation
  if(response == 0){
    printError("captchaErr", "Please verify that you are not a robot");
  }else{
    printError("captchaErr", " ");
    captchaErr = false;
  }

  if((firstErr || lastErr || dobErr || amkaErr || emailErr || passErr || captchaErr) == true) {
    return false;
  } 
  else {
    // Creating a string from input data for preview
    var dataPreview = "You've entered the following details: \n" +
                      "Name: " + firstName + "\n" +
                      "Last name: " + lastName + "\n" +
                      "DOB: " + dob + "\n" +
                      "AMKA : " + amka + "\n" +
                      "Email : " + email + "\n" +
                      "Password : " + password ;
                      

    // Display input data in a dialog box before submitting the form
    alert(dataPreview);
  }
};
</script>

    <!-- *** REGISTRATION FORM *** -->
    <div class="ui container left-aligned-container">
      <h1 class="ui inverted header">
        medbase
      </h1>
      <h2 class="bolder-font">Register with your AMKA</h2>
      
      <div class="ui two column stackable container">
        <div class="column padding">
          <div class="ui segment">
            <!-- FORM -->
            <form name="form" method="POST" class="ui form" onsubmit="return validateForm();">  
              <div class="field">
                <div class="two fields">
                    <div class="field">
                    <label>First Name (required)  <span class="error" id="firstErr"></span> </label> 
                      <input type="text" name="first_name" placeholder="First Name" onkeyup="lettersOnly(this)" onselectstart="return false"  />                
            <?php if(isset($errorname)){ ?> .
              <div class="alert alert-danger" role="alert"> 
                <?php echo $errorname; ?> 
              </div>
            <?php } ?>
                    </div>
                    
                    <div class="field">
                    <label>Last Name (required) <span class="error" id="lastErr"></span> </label>
                        <input type="text" name="last_name" placeholder="Last Name" onkeyup="lettersOnly(this)" />
                    </div>
                </div>
              </div>
              <div class="field">

              
                <div class="two fields">
                    <div class="field">
                    <label>Date of Birth (required) <span class="error" id="dobErr"></span> </label>
                      <input type="date" name="dob" placeholder="Date of Birth" />
                    </div>
                    <div class="field">
                    <label>Your AMKA (required)  <span class="error" id="amkaErr"></span> </label>
                        <input type="text" name="amka" placeholder="AMKA" onkeyup="lettersOnly(this)" />
                    </div>
                </div>
              </div>
              <div class="field">

              </div> 
                  
              <div class="field">
              <label>Your Email ( Optional ) <span class="error" id="emailErr"></span> </label>     
                <div class="ui left icon input">
                  <i class="user icon"></i>
                  <input type="email" name="email" id="email" placeholder="E-mail address" />
                </div>
              </div>
      
              <div class="field">
              <label>Your password <span class="error" id="passErr"></span> </label> 
                <div class="ui left icon input">
                  <i class="lock icon"></i>            
                  <input type="password" name="password" id="password" placeholder="Password"  />     
                </div>
                
                <p>
                  <div class="ui checkbox">
                    <input type="checkbox" onclick="myShowPass()">     <label>Show password</label>         
                  </div>
                </p>

                <script>
                  function myShowPass() {
                    var x = document.getElementById("password");
                    if (x.type === "password") {
                      x.type = "text";
                      } 
                        else{
                          x.type = "password";
                        }
                    }       
                  </script>
                <progress max="100" value="0" id="strength" style="width : 100%; height: 15px; "></progress>
              
                <div class="ui info message">
                  <i class="close icon"></i>
                  <div class="header">
                    Your Password must contain :
                  </div>
                  <ul class="list">
                    <li>A Number, an Upper and Lower Case letter and a Special Character!</li>
                    <li>Password must be at least 8 Characters!</li>
                  </ul>
                </div>

                <script>  
                
                var password_strength = document.getElementById("password");
                password_strength.addEventListener('keyup', function(){
                  checkPassword(password_strength.value);
                });
                function checkPassword(password){
                  var anUpperCase = /[A-Z]/;
                  var aLowerCase = /[a-z]/; 
                  var aNumber = /[0-9]/;
                  var aSpecial = /[!|@|#|$|%|^|&|*|(|)|-|_]/;
                  // var a = document.getElementById("pass-hint");
                  var bar = document.getElementById("strength");
                  var strength = 0; 

                  if(password == "" || password.length >= 0){
                    strength = 0;
                  }

                  if(password.match(anUpperCase)){
                    strength +=1;
                  }

                  if(password.match(aNumber)){
                    strength +=1;
                  }

                  if(password.match(aSpecial)){
                    strength +=1;
                  }

                  
                  if(password.match(aLowerCase)){
                    strength +=1;
                  }

                  if(password.length >= 8){
                    strength +=1;  
                  }

                  switch(strength){
                    case 0:
                          bar.value = 0;
                          break;
                    case 1:
                          bar.value = 20;
                          break;
                    case 2:
                          bar.value = 40;
                          break;
                    case 3:
                          bar.value = 60;
                          break;

                    case 4:
                          bar.value = 80;
                          break;

                    case 5:
                          bar.value = 100;
                          break;

                  }
                }


                </script>
              </div>
              
                <?php if(isset($msg_success)){ ?><div class="ui positive message" role="alert"><div class="header"><?php echo $msg_success; ?></div></div><?php } ?>
                <?php if(isset($msg_empty_inputs)){ ?><div class="ui negative message"><?php echo $msg_empty_inputs; ?></div><?php } ?>

                <p>Any more informations we should know  ? <i style="color:#999;">(Optional)</i> :</p> <textarea cols="25" maxlength="250" rows = "4" name="Comment" style="resize : none; width: 100% ;">  </textarea></p> 

                  <!-- Recaptcha Validation -->
                  <span class="error" id="captchaErr"></span>
                  <!-- check if user clicks the captcha checkbox , and print it in console -->
                  <div class="g-recaptcha" id="resize-recaptcha" data-sitekey="6LczemkUAAAAAAW_VUv6MgPvVCsAnoIHhNqJR0Ao"></div>           
                  <?php if(isset($captchaFail)){ ?>
                  <div class="ui error message">
                  <?php echo $captchaFail; ?> 
                  </div><?php } ?>

                </p>

                <input class="ui fluid large primary submit button" type="submit" name="submit" value="Submit" id="submit" />            
                <div class="ui message">
                  <p>Already have an account ? Login <a href="../index.php" style="text-decoration: underline;">here</a></p>
                </div> 
              
              </div>
            </form>     
          <!-- END FORM -->
          </div>
          
        </div>
        
      </div>
      <div> 
  </div>
  
</div>


<div class="ui inverted vertical footer segment">
    <div class="ui container">
      <div class="ui stackable inverted divided equal height stackable grid">
        <div class="three wide column">
          <h4 class="ui inverted header">About</h4>
          <div class="ui inverted link list">
            <a href="#" class="item">Sitemap</a>
            <a href="#" class="item">Contact Us</a>
            <a href="#" class="item">Religious Ceremonies</a>
            <a href="#" class="item">Gazebo Plans</a>
          </div>
        </div>
        <div class="three wide column">
          <h4 class="ui inverted header">Services</h4>
          <div class="ui inverted link list">
            <a href="#" class="item">Banana Pre-Order</a>
            <a href="#" class="item">DNA FAQ</a>
            <a href="#" class="item">How To Access</a>
            <a href="#" class="item">Favorite X-Men</a>
          </div>
        </div>
        <div class="seven wide column">
          <h4 class="ui inverted header">Footer Header</h4>
          <p>Extra space for a call to action inside the footer that could help re-engage users.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
 //Notification message (warnings) close window - when 'x' icon is pressed
$('.message .close')
    .on('click', function() {
      $(this)
        .closest('.message')
        .transition('fade');
    });
</script>
</body>