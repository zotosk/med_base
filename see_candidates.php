
<?php
require 'dbconnect/dbconnect.php';

$q = $_GET["search_bar"];

if(isset($q))
{  
  $search = $dbconnect->prepare("SELECT * FROM users WHERE looking_for like ?");
  $search->execute(array("%$q%"));
} 

?>

<!DOCTYPE html>
<html lang="en-gb" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Search candidates</title>
  <script src="js/jquery-3.3.1.min.js"></script>
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon.png">
  <link rel="stylesheet" href="css/uikit.min.css">
  <script src="js/uikit.min.js"></script>
</head>

<body>

<div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
    <img src="img/candid.png" width="100" >
    <div style="padding: 1.3em 0">
            <nav class="uk-navbar uk-margin-large-bottom">
                <ul class="uk-navbar-nav uk-hidden-small">
                    <li class="uk-active">
                        <a href="main_info.php">Home page</a>
                    </li>
                    <li class="uk-active">
                        <a href="login.php">Search</a>
                    </li>
                    <li>
                        <a href="user_profile_register/pdo_register.php">Register</a>
                    </li>
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                </ul>
                <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
            </nav>

            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-1-1 uk-text-center">
                    <h1 class="uk-heading-large uk-margin-top">Search results</h1>
                    <p class="uk-text-large">You can <a href="login.php">search</a> for a candidate skill. <br>(e.g. developer,java,sql,lawyer)</p>
                </div>
            </div>


            <?php 
            
            if (!$search->rowCount()) {
                echo "<h3 class='uk-width-medium-1-5 uk-text-center' style='color:orange';>Search for : ".$_GET['search_bar']."<h3><h2 style='color:red'; class='uk-width-medium-1-5 uk-text-center'>No results found</h2>";
            }
            else {

            foreach ($search as $user) { 
                
            ?>

            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-5 uk-text-center">
                    <div class="uk-thumbnail uk-overlay-hover uk-border-circle">
                        <figure class="uk-overlay">
                            <img class="uk-border-circle" width="120" src="img\profile_pic.png" alt="profile_pic">
                        
                            <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle uk-text-center uk-border-circle">
                                <div>
                                    <a href="mailto:<?=$user["email"];?>" class="uk-icon-button uk-icon-envelope"></a>								
                                    <a href="#" class="uk-icon-button uk-icon-twitter"></a>
                                    <a href="#" class="uk-icon-button uk-icon-google-plus"></a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                    <h2 class="uk-margin-bottom-remove"><?=$user["first_name"]." ".$user["last_name"];?></h2>
					<span>Previous job position </span><p class="uk-text-large uk-margin-top-remove uk-text-muted"><?=$user["p_job"];?></p>
                    <span>Current job position </span><p class="uk-text-large uk-margin-top-remove uk-text-muted"><?=$user["c_job"];?></p>
                    <span>Looking for </span><p class="uk-text-large uk-margin-top-remove uk-text-muted"><?=$user["looking_for"];?></p>
                    
                </div>
            </div>
            
            <hr class="uk-grid-divider">

        <?php } } ?>

            

        <div id="offcanvas" class="uk-offcanvas">
            <div class="uk-offcanvas-bar">
                <ul class="uk-nav uk-nav-offcanvas">
                    <li>
                        <a href="main_info.php">Home page</a>
                    </li>
                    <li class="uk-active">
                        <a href="login.php">Search</a>
                    </li>
                    <li>
                        <a href="#">Contact us</a>
                    </li>
                    <li>
                        <a href="user_profile_register/pdo_register.php">Register</a>
                    </li>
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>