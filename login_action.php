<?php
echo ("Hello world");
require_once 'bootstrap.php';
require_once 'AuthenticationManager.php';

$authManager = new AuthenticationManager($studentRepo);

$authManager->login();
