<?php

require 'header.php';

?>
<!DOCTYPE HTML>
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
    <meta http-equiv="refresh" content="3;url=connect.php" />
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
        <div id="margin_zero" class="content has-text-centered is-size-6">Welcome!</div>
        <div id="margin_zero" class="content has-text-centered is-size-6">You'll be automatically authorized</div>
        <div id="margin_zero" class="content has-text-centered is-size-6">on the network in a few moments</div>
      </div>
    </section>
  </div>

</div>
</body>

</html>
