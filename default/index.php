<?php

require 'header.php';
include 'config.php';

$_SESSION["id"] = $_GET['id'];
$_SESSION["ap"] = $_GET['ap'];
$_SESSION["user_type"] = "new";

//# Checking DB to see if user exists or not.
//$result = mysqli_query($con, "SELECT * FROM `$table_name` WHERE mac='$_SESSION[id]'");
//
//if ($result->num_rows >= 1) {
//  $row = mysqli_fetch_array($result);
//
//  mysqli_close($con);
//
//  $_SESSION["user_type"] = "repeat";
//  header("Location: welcome.php");
//} else {
//  mysqli_close($con);
//}

# Google login parameters

$client_id = $_SERVER['CLIENT_ID'];
$client_secret = $_SERVER['CLIENT_SECRET'];
$client_redirect_url = $_SERVER['CLIENT_REDIRECT_URL'];

$google_login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode($client_redirect_url) . '&response_type=code&client_id=' . $client_id . '&access_type=online';

?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>
      <?php echo htmlspecialchars($business_name); ?> WiFi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="../assets/styles/bulma.min.css"/>
    <link rel="stylesheet" href="../vendor/fortawesome/font-awesome/css/all.css"/>
    <link rel="icon" type="image/png" href="../assets/images/favicomatic/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="../assets/images/favicomatic/favicon-16x16.png" sizes="16x16"/>
    <link rel="stylesheet" href="../assets/styles/style.css"/>
</head>

<body>
<div class="page">

    <div class="head">
        <br>
        <figure id="logo">
            <img src="../assets/images/logo.png">
        </figure>
    </div>

    <div class="main">
        <section class="section">
            <div class="container">
                <div id="login" class="content is-size-5 has-text-centered has-text-weight-bold">Enter your details
                </div>
                <form method="post" action="connect.php">
                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="input" type="text" id="form_font" name="fname" placeholder="First Name"
                                   required>
                            <span class="icon is-small is-left">
                              <i class="fas fa-user"></i>
                            </span>
                        </div>
                    </div>

                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="input" type="text" id="form_font" name="lname" placeholder="Last Name"
                                   required>
                            <span class="icon is-small is-left">
                              <i class="fas fa-user"></i>
                            </span>
                        </div>
                    </div>

                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="input" type="email" id="form_font" name="email" placeholder="Email" required>
                            <span class="icon is-small is-left">
                              <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                    </div>
                    <br>
                    <div class="columns is-centered is-mobile">
                        <div class="control">
                            <label class="checkbox">
                                <input type="checkbox" required>
                                I agree to the <a href="policy.php">Terms of Use</a>
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="buttons is-centered">
                        <button class="button is-link">Connect</button>
                    </div>
                </form>
            </div>
            <br>
            <div id="logintext" class="content has-text-centered is-size-5 has-text-weight-bold">Or login using:</div>
            <br>
            <div class="container has-text-centered">
                <a href="<?php echo htmlspecialchars($google_login_url); ?>">
                    <i class="fab fa-google fa-2x"></i>
                </a>
            </div>
        </section>
    </div>
</div>
</body>

</html>