<?php

require 'header.php';
include 'config.php';

$client_id = $_SERVER['CLIENT_ID'];
$client_secret = $_SERVER['CLIENT_SECRET'];
$client_redirect_url = $_SERVER['CLIENT_REDIRECT_URL'];

class GoogleLoginApi
{
  public function GetAccessToken($client_id, $redirect_uri, $client_secret, $code) {
    $url = 'https://accounts.google.com/o/oauth2/token';

    $curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
    $data = json_decode(curl_exec($ch), true);
    $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
    if($http_code != 200)
      throw new Exception('Error : Failed to receieve access token');

    return $data;
  }

  public function GetUserProfileInfo($access_token) {
    $url = 'https://www.googleapis.com/oauth2/v3/userinfo';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));
    $data = json_decode(curl_exec($ch), true);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if($http_code != 200)
      throw new Exception('Error : Failed to get user information');

    return $data;
  }
}

if(isset($_GET['code'])) {
  try {
    $gapi = new GoogleLoginApi();

    // Get the access token
    $data = $gapi->GetAccessToken($client_id, $client_redirect_url, $client_secret, $_GET['code']);

    // Access Tokem
    $access_token = $data['access_token'];

    // Get user information
    $user_info = $gapi->GetUserProfileInfo($access_token);

    // Now that the user is logged in you may want to start some session variables

    print_r($user_info);

//    $_SESSION["fname"] = $user_info['given_name'];
//    $_SESSION["lname"] = $user_info['family_name'];
//    $_SESSION["email"] = $user_info['email'];
//    $_SESSION["method"] = "Google";

    // You may now want to redirect the user to the home page of your website
//    header("Location: connect.php");

  }
  catch(Exception $e) {
    echo $e->getMessage();
    exit();
  }
}

?>
