<?php
require_once 'bootstrap.php';

$authManager->logout();
header("Location: index.php");
?>