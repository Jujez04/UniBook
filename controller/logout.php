<?php
require_once 'bootstrap.php';

$authManager->logout();
header("Location: " . BASE_URL . "index.php");
