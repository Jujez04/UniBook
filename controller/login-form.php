<?php
require_once 'bootstrap.php';

$templateParams["title"] = "Unibook - Login";

$templateParams["content"] =  BASE_PATH . "/UniBook/view/login-form-view.php";
$templateParams["css"] = "user_style.css";

require  '../template/base.php';
?>