<?php
require_once 'assets/vendor/autoload.php';

$google_client = new Google_Client();

$google_client->setClientId('951851847559-8tatd5c12itu6lg7he2utf6aflbefg1v.apps.googleusercontent.com');

$google_client->setClientSecret('b2NhOY7TDFlw0VzFPINd8IvW');

$google_client->setRedirectUri('http://localhost/pets/signup.php');

$google_client->addScope('email');

$google_client->addScope('profile');

$google_client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile'));
?>