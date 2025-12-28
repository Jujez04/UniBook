<?php
require_once 'bootstrap.php';
require_once 'AuthenticationManager.php';

$authManager = new AuthenticationManager($studentRepo, $sessionManager);

$authManager->login();
?>