<?php

require 'header.php';
include 'config.php';

$check_table_query = "SHOW TABLES LIKE '$table_name'";
$result = mysqli_query($con, $check_table_query);

if (mysqli_num_rows($result) == 0) {
    $create_table_query = "
            CREATE TABLE `$table_name` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `mac` VARCHAR(17) NOT NULL,
                `first_name` VARCHAR(50) DEFAULT NULL,
                `last_name` VARCHAR(50) DEFAULT NULL,
                `email` VARCHAR(255) DEFAULT NULL,
                `method` VARCHAR(50) DEFAULT NULL,
                `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
            );
        ";
    if (!mysqli_query($con, $create_table_query)) {
      die("Error: Could not create table '$table_name': " . mysqli_error($con));
    }
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_GET['id'])) {
  $_SESSION["id"] = htmlspecialchars($_GET['id']);
  $_SESSION["ap"] = htmlspecialchars($_GET['ap']);
  $_SESSION["user_type"] = "new";
  $_SESSION["method"] = "Form";
  $user_error = false;
}

if (isset($_POST['connect'])) {
    $secret = $_SERVER['GUEST_SECRET'];
    if ($secret == $_POST['pass']) {
        header("Location: connect.php");
    } else {
        $user_error = true;
    }
}

try {
    $stmt = $con->prepare("SELECT * FROM `$table_name` WHERE mac=?");
    if ($stmt === false) {
        throw new Exception("Failed to prepare statement: " . $con->error);
    }
    $stmt->bind_param("s", $_SESSION["id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

if ($result->num_rows >= 1) {
    $row = mysqli_fetch_array($result);

    mysqli_close($con);

    $_SESSION["user_type"] = "repeat";
    header("Location: welcome.php");
} else {
    mysqli_close($con);
}

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
                <div id="logintext" class="content has-text-centered is-size-6 has-text-weight-bold">Employee SSO Login
                </div>
                <div class="container has-text-centered">
                    <a href="<?php echo htmlspecialchars($google_login_url); ?>">
                        <i class="fab fa-google fa-2x"></i>
                    </a>
                </div>
                <br>
                <div id="login" class="content has-text-centered is-size-6 has-text-weight-bold">Guest Login
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                  <?php
                  if ($user_error) {
                      ?>
                    <div class="content is-size-6 has-text-centered has-text-danger">
                        Sorry, the password is incorrect
                    </div>
                  <?php
                  }
?>
                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="input" type="password" name="pass" placeholder="Password" required>
                            <span class="icon is-small is-left">
                              <i class="fas fa-key"></i>
                            </span>
                        </div>
                    </div>
                    <br>
                    <div class="buttons is-centered">
                        <input class="button" type="submit" name="connect" value="Connect">
                    </div>
                </form>
            </div>
            <br>
        </section>
    </div>
</div>
</body>

</html>
