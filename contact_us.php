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
                <div class="uk-navbar-brand uk-navbar-center uk-visible-small">
                <a href="login.php">Login</a>
                </div>
            </nav>

            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-1-1 uk-text-center uk-row-first">
                    <h1 class="uk-heading-large">Contact</h1>
                    <p class="uk-text-large">Contact us if you experience any problem, or for any further information.Will be glad to assist you!</p>
                </div>
            </div>

           

            <hr class="uk-grid-divider">

            <div class="uk-grid" data-uk-grid-margin="">

                <div class="uk-width-medium-2-3 uk-row-first">
                    <div class="uk-panel uk-panel-header">

                        <h3 class="uk-panel-title">Get in touch</h3>

                        <form class="uk-form uk-form-stacked">

                            <div class="uk-form-row">
                                <label class="uk-form-label">Your Name</label>
                                <div class="uk-form-controls">
                                    <input type="text" placeholder="" class="uk-width-1-1">
                                </div>
                            </div>

                            <div class="uk-form-row">
                                <label class="uk-form-label">Your Email</label>
                                <div class="uk-form-controls">
                                    <input type="text" placeholder="" class="uk-width-1-1">
                                </div>
                            </div>

                            <div class="uk-form-row">
                                <label class="uk-form-label">Your Message</label>
                                <div class="uk-form-controls">
                                    <textarea class="uk-width-1-1" id="form-h-t" cols="100" rows="9"></textarea>
                                </div>
                            </div>

                            <div class="uk-form-row">
                                <div class="uk-form-controls">
                                    <button class="uk-button uk-button-primary">Submit</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

                <div class="uk-width-medium-1-3 uk-grid-margin uk-row-first">
                    <div class="uk-panel uk-panel-box uk-panel-box-secondary">
                        <h3 class="uk-panel-title">Contact Details</h3>
                        <p>
                            <strong>Candid</strong>
                            <br>Athens, Greece
                            <br>ZipCode : 111111
                        </p>
                        <p>
                            <a>candid-info@mail.com</a>
                        </p>
                        <h3 class="uk-h4">Follow Us</h3>
                        <p>
                            <a href="#" class="uk-icon-button uk-icon-facebook"></a>
                            <a href="#" class="uk-icon-button uk-icon-twitter"></a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
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