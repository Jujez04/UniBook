<?php
require_once 'bootstrap.php';

$templateParams["title"] = "Unibook - Registrazione";

$templateParams["content"] =  BASE_PATH . "/UniBook/view/register-form-view.php";
$templateParams["css"] = "user_style.css";

require  '../template/base.php';
