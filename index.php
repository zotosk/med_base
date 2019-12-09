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
      $dbquery = "SELECT * FROM `users` where email = ? AND password = ?";
      $statement = $dbconnect->prepare($dbquery);  
      
      include_once 'hash_validation.php';

      $statement->execute(  
      array($_POST["email"],$passwordHash));
      
      $count = $statement->rowCount(); 
        if($count > 0 ) 
        {  
          $_SESSION["email"] = $email;
          $msg_success="&#10004;  Login successful ! ";  
          header("refresh:1;url=login_success.php");        
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
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  
  <!-- Site Properties -->
  <title>medbase|login</title>

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
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <style type="text/css">

    .medbase-h1-top{
      font-size: 4em !important;
    }

    .hidden.menu {
      display: none;
    }

    .bg-img{
      background-image: url('img/bg.jpg') !important;
      background: #F3F4F5;
      background-size: cover !important;
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
      font-weight: normal;
      color: rgba(62, 94, 158, 0.527);
    }

    h2.bolder-font{
      font-size: 2.5em !important;
      font-weight: bolder;
    }

    .no-padding-left{
      padding-left : 0px !important;
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
</head>
<body>
  
<!-- Following Menu -->
<div class="ui large top fixed hidden menu">
  <div class="ui container">
    <a class="item">Home</a>
    <a class="item">About</a>
    <a class="item">FAQ</a>
    <a class="item">Contact us</a>
    <div class="right menu">
      <div class="item">
        <a class="ui button">Log in</a>
      </div>
      <div class="item">
        <a class="ui primary button" href="user_profile_register/user_register.php">Sign Up</a>
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
  <a class="item" href="user_profile_register/user_register.php">Signup</a>
</div>


<!-- Page Contents -->
<div class="pusher">
  <div class="ui inverted vertical masthead center aligned segment bg-img">
    <div class="ui container">
      <div class="ui large secondary inverted pointing menu">
        <a class="toc item" style="text-decoration:none;">
          <i class="sidebar icon"></i>
        </a>
        <a class="item" style="padding-left:0px;">Home</a>
        <a class="item">About</a>
        <a class="item">FAQ</a>
        <a class="item">Contact us</a>
        <div class="right item">
          <a class="medium ui button">Log in</a>
          <a class="medium ui button" href="user_profile_register/user_register.php">Sign Up</a>
        </div>
      </div>
    </div>

    <div class="ui container left-aligned-container">
      <h1 class="ui inverted header">
        medbase
      </h1>
      <h2 class="bolder-font">Best Outcome for Every Patient Every Time.<br> Feel like home.</h2>
      <!-- <div class="ui large primary button">Read more <i class="right arrow icon"></i></div> -->
      <div class="ui two column stackable grid container">
        <div class="column no-padding-left">
          <div class="ui segment">
        <!-- FORM -->
            <form method="POST" class="ui form"> 
              <div class="field">
                <div class="ui left icon input">
                  <i class="user icon"></i>
                  <input type="text" name="email" placeholder="E-mail address" required>
                </div>
              </div>
              <div class="field">
                <div class="ui left icon input">
                  <i class="lock icon"></i>
                  <input type="password" name="password" placeholder="Password" required>
                </div>
              </div>
                <?php if(isset($msg_alert)){ ?><div class="uk-alert-danger" role="alert"> <?php echo $msg_alert; ?> </div><?php } ?>
                <?php if(isset($msg_success)){ ?><div class="uk-alert-success" role="alert"><?php echo $msg_success; ?>  <i class="uk-icon-spinner uk-icon-spin"></i></div><?php } ?>
                <?php if(isset($msg_empty_inputs)){ ?><div class="uk-alert-danger" role="alert"> <?php echo $msg_empty_inputs; ?> </div><?php } ?>
                <input class="ui fluid large primary submit button" type="submit" name="submit" value="Login" id="submit">
                <div class="ui message">
                  <p>Dont have an account? Register <a href="user_profile_register/user_register.php" style="text-decoration: underline;">here</a></p>
                </div>      
              </div>
            </form>     
          <!-- END FORM -->
          </div>
        </div>
      </div>     
  </div>

  <div class="ui vertical stripe segment">
    <div class="ui middle aligned stackable grid container">
      <div class="row">
        <div class="eight wide column">
          <h3 class="ui header">Our vision</h3>
          <p>We can give your company superpowers to do things that they never thought possible. Let us delight your customers and empower your needs...through pure data analytics.</p>
          <h3 class="ui header">What we do</h3>
          <p>We care, our health is the # 1 priority.We Yes that's right, you thought it was the stuff of dreams, but even bananas can be bioengineered.</p>
        </div>
        <div class="six wide right floated column">
          <img src="img/vision.jpg" class="ui large bordered rounded image">
        </div>
      </div>
      <div class="row">
        <div class="center aligned column">
          <a class="ui huge button">Check Them Out</a>
        </div>
      </div>
    </div>
  </div>
  
  <div class="ui vertical stripe quote segment">
    <div class="ui equal width stackable internally celled grid">
      <div class="center aligned row">
        <div class="column">
          <h3>"About medbase"</h3>
          <p>Medbase is the first free to use web app that you will be able to download and have immidiate access to your medical history and your examinations.</p>
        </div>
        <div class="column">
          <h3>"The dream"</h3>
          <p>
            A united system for public hospitals where every patient can view and get their examinations online.Technology is here, we must use it for our benefit not constrain it.
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="ui vertical stripe segment">
    <div class="ui text container">
      <h3 class="ui header">Breaking The Grid, Grabs Your Attention</h3>
      <p>Instead of focusing on content creation and hard work, we have learned how to master the art of doing nothing by providing massive amounts of whitespace and generic content that can seem massive, monolithic and worth your attention.</p>
      <a class="ui large button">Read More</a>
      <h4 class="ui horizontal header divider">
        <a href="#">Case Studies</a>
      </h4>
      <h3 class="ui header">Did We Tell You About Our Bananas?</h3>
      <p>Yes I know you probably disregarded the earlier boasts as non-sequitur filler content, but its really true. It took years of gene splicing and combinatory DNA research, but our bananas can really dance.</p>
      <a class="ui large button">I'm Still Quite Interested</a>
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
</body>

</html>
