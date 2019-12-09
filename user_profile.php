<?php
// require 'dbconnect/dbconnect.php';
include 'user_profile_details.php';

if(ISSET($_POST["submit"]))
  {

    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $p_job = $_POST['p_job'];
    $c_job = $_POST['c_job'];
    $looking_for = $_POST['looking_for'];
    $education_lvl = $_POST['education_lvl'];

    $sql = "UPDATE users SET first_name    = '$first_name',
                             last_name     = '$last_name',
                             age           = '$age',
                             p_job         = '$p_job',
                             c_job         = '$c_job',
                             looking_for   = '$looking_for',
                             education_lvl = '$education_lvl' WHERE email = '$email'";
    $stmt= $dbconnect->prepare($sql);
    $result = $stmt->execute();
    if($result)
    {
        header('Refresh: 2');
        $successMsg = "Success! Profile details updated.";
    }else{
        $msg_alert = "Something went wrong.Try again!";
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
  <link rel="stylesheet" type="text/css" href="semantic/components/reset.css">
  <link rel="stylesheet" type="text/css" href="semantic/components/site.css">

  <link rel="stylesheet" type="text/css" href="semantic/components/container.css">
  <link rel="stylesheet" type="text/css" href="semantic/components/grid.css">
  <link rel="stylesheet" type="text/css" href="semantic/components/header.css">
  <link rel="stylesheet" type="text/css" href="semantic/components/image.css">
  <link rel="stylesheet" type="text/css" href="semantic/components/menu.css">
  <link rel="stylesheet" type="text/css" href="semantic/components/input.css">
  <link rel="stylesheet" type="text/css" href="semantic/components/form.css">
  <!-- <link rel="stylesheet" type="text/css" href="semantic/components/form.js"> -->
  <link rel="stylesheet" type="text/css" href="semantic/components/message.css">

  <link rel="stylesheet" type="text/css" href="semantic/components/divider.css">
  <link rel="stylesheet" type="text/css" href="semantic/components/dropdown.css">
  <link rel="stylesheet" type="text/css" href="semantic/components/segment.css">
  <link rel="stylesheet" type="text/css" href="semantic/components/button.css">
  <link rel="stylesheet" type="text/css" href="semantic/components/list.css">
  <link rel="stylesheet" type="text/css" href="semantic/components/icon.css">
  <link rel="stylesheet" type="text/css" href="semantic/components/sidebar.css">
  <link rel="stylesheet" type="text/css" href="semantic/components/transition.css">

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

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="semantic/components/visibility.js"></script>
  <script src="semantic/components/sidebar.js"></script>
  <script src="semantic/components/transition.js"></script>
  <script src="semantic/components/dropdown.js"></script>
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
        <a class="item" href="logout.php" style="padding-left:0px;">Home</a>
        <div class="right item">
          <a class="medium ui button" href="logout.php">Log out</a>
        </div>
      </div>
    </div>
    <script src="../../js/async.js"></script>

            <form class="uk-panel uk-panel-box uk-form" method="POST" action="user_profile.php">
            <?php if(isset($successMsg)){ ?><div class="uk-alert-success2" role="alert"><?php echo $successMsg; ?></div><?php } ?>
            <?php if(isset($msg_alert)){ ?><div class="uk-alert-danger2" role="alert"> <?php echo $msg_alert; ?> </div><?php } ?>
                <div class="uk-width-medium-1-1">
                    <div class="uk-form-row">

                    <label for="first_name" class="uk-legend_1">First Name</label>
                    <div class="form-group uk-margin">
                    <input type="text" class="uk-input uk-form-width-medium" placeholder="<?php echo $row['first_name'];?>" name="first_name" value="<?php echo $row['first_name'];?>"/>
                    </div>

                    <label for="last_name" class="uk-legend_1">Last Name</label>
                    <div class="form-group uk-margin">
                    <input type="text" class="uk-input uk-form-width-medium" placeholder="<?php echo $row['last_name'];?>" name="last_name" value="<?php echo $row['last_name'];?>"/>
                    </div>

                    <label for="age" class="uk-legend_1">Age</label>
                    <div class="form-group uk-margin">
                        <input type="number" min="0" max="199" class="uk-input uk-form-width-medium" placeholder="<?php echo $row['age'];?>" name="age" value="<?php echo $row['age'];?>"/>
                    </div>

                    <label for="email" class="uk-legend_1">Email</label>
                    <div class="form-group uk-margin">
                    <input type="text" readonly class="uk-input uk-form-width-medium" placeholder="<?php echo $row['email'];?>" name="email" value="<?php echo $row['email'];?>"/>
                    </div>

                    <label for="p_job" class="uk-legend_1">Previous job</label>
                    <div class="form-group uk-margin">
                    <input type="text" class="uk-input uk-form-width-medium" placeholder="<?php echo $row['p_job'];?>" name="p_job" value="<?php echo $row['p_job'];?>"/>
                    </div>
                    
                    <label for="c_job" class="uk-legend_1">Current job</label>
                    <div class="form-group uk-margin">
                    <input type="text" class="uk-input uk-form-width-medium" placeholder="<?php echo $row['c_job'];?>" name="c_job" value="<?php echo $row['c_job'];?>"/>
                    </div>

                    <label for="looking_for" class="uk-legend_1">Looking for</label>
                    <div class="form-group uk-margin">
                    <input type="text" class="uk-input uk-form-width-medium" placeholder="<?php echo $row['looking_for'];?>" name="looking_for" value="<?php echo $row['looking_for'];?>"/>
                    </div>

                    <label for="education_lvl" class="uk-legend_1">Education</label>
                    <div class="form-group uk-margin">
                    <input type="text" class="uk-input uk-form-width-medium" placeholder="<?php echo $row['education_lvl'];?>" name="education_lvl" value="<?php echo $row['education_lvl'];?>"/>
                    </div>

                    <div class="form-group uk-margin">
                    <input type="submit" class = "uk-button uk-button-primary uk-button-large" name="submit" id="submit" value="Save changes" style="color: #fff;letter-spacing: 0.6;font-size:1.3rem;"/>
                    </div>
                </div> 
            </form>   
        </div>  
    </div>              

</body>
</html>