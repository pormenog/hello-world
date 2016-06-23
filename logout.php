<?php

session_start();
session_destroy();

require_once 'config.php';
require_once 'google/Google_Client.php';
$client = new Google_Client();

unset($_SESSION['token']);
$client->revokeToken();
header('Location: '.$base_url);
?>