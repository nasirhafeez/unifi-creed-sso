<?php

require 'header.php';
include 'config.php';

$mac = $_SESSION["id"];
$apmac = $_SESSION["ap"];
$user_type = $_SESSION["user_type"];
$method = $_SESSION["method"];
$last_updated = date("Y-m-d H:i:s");

if ($user_type == "new") {

    $stmt = $con->prepare("CREATE TABLE IF NOT EXISTS `$table_name` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `mac` varchar(45) NOT NULL,
      `method` varchar(45) NOT NULL,
      `last_updated` varchar(45) NOT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY (mac)
      )");
    $stmt->execute();

    $stmt = $con->prepare("INSERT INTO `$table_name` (mac, method, last_updated) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $mac, $method, $last_updated);
    $stmt->execute();
}

$controlleruser = $_SERVER['CONTROLLER_USER'];
$controllerpassword = $_SERVER['CONTROLLER_PASSWORD'];
$controllerurl = $_SERVER['CONTROLLER_URL'];
$controllerversion = $_SERVER['CONTROLLER_VERSION'];
$duration = $_SERVER['DURATION'];

$debug = false;

$site_id = $_SERVER['SITE_ID'];

$unifi_connection = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id, $controllerversion);
$set_debug_mode   = $unifi_connection->set_debug($debug);
$loginresults     = $unifi_connection->login();

$auth_result = $unifi_connection->authorize_guest($mac, $duration, null, null, null, $apmac);

?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($business_name); ?> WiFi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="../assets/styles/bulma.min.css" />
    <link rel="stylesheet" href="../vendor/fortawesome/font-awesome/css/all.css" />
    <meta http-equiv="refresh" content="3;url=https://www.google.com" />
    <link rel="icon" type="image/png" href="../assets/images/favicomatic/favicon-32x32.png" sizes="32x32" />
    <link rel="stylesheet" href="../assets/styles/style.css" />
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
       <seection class="section">
           <div id="margin_zero" class="content has-text-centered is-size-6">Thanks, you are now </div>
           <div id="margin_zero" class="content has-text-centered is-size-6">authorized on WiFi</div>
       </seection>
    </div>

</div>
</body>
</html>
