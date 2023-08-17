<?php

require 'header.php';
require 'GoogleLoginApi.php';

$client_id = $_SERVER['CLIENT_ID'];
$client_secret = $_SERVER['CLIENT_SECRET'];
$client_redirect_url = $_SERVER['CLIENT_REDIRECT_URL'];

$gapi = new GoogleLoginApi();

if(isset($_GET['code'])) {
    try {
//        $data = $gapi->GetAccessToken($client_id, $client_redirect_url, $client_secret, $_GET['code']);
//        $access_token = $data['access_token'];
//        $user_info = $gapi->GetUserProfileInfo($access_token);
//        $_SESSION["fname"] = $user_info['given_name'];
//        $_SESSION["lname"] = $user_info['family_name'];
//        $_SESSION["email"] = $user_info['email'];
        $_SESSION["method"] = "Google";

        header("Location: connect.php");

    } catch(Exception $e) {
        echo $e->getMessage();
        exit();
    }
}
