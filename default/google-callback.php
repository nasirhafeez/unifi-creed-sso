<?php

require 'header.php';

$client_id = $_SERVER['CLIENT_ID'];
$client_secret = $_SERVER['CLIENT_SECRET'];
$client_redirect_url = $_SERVER['CLIENT_REDIRECT_URL'];

if(isset($_GET['code'])) {
  try {
//    $gapi = new GoogleLoginApi();

    // Get the access token
//    $data = $gapi->GetAccessToken($client_id, $client_redirect_url, $client_secret, $_GET['code']);

    // Access Tokem
//    $access_token = $data['access_token'];

    // Get user information
//    $user_info = $gapi->GetUserProfileInfo($access_token);

    // Now that the user is logged in you may want to start some session variables

//    $_SESSION["fname"] = $user_info['given_name'];
//    $_SESSION["lname"] = $user_info['family_name'];
//    $_SESSION["email"] = $user_info['email'];
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
