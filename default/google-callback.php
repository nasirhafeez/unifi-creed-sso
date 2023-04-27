<?php
require 'header.php';
require 'google-config.php';
require 'GoogleLoginApi.php';

$gapi = new GoogleLoginApi();

if(isset($_GET['code'])) {
  try {
    // Get the access token
    $data = $gapi->GetAccessToken($client_id, $client_redirect_url, $client_secret, $_GET['code']);

    // Access Token
    $access_token = $data['access_token'];

    // Get user information
    $user_info = $gapi->GetUserProfileInfo($access_token);

    // Now that the user is logged in you may want to start some session variables
    $_SESSION["method"] = "Google";

    // You may now want to redirect the user to the home page of your website
    header("Location: connect.php");

  }
  catch(Exception $e) {
    echo $e->getMessage();
    exit();
  }
}

?>
