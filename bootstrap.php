<?php
session_start();
define("UPLOAD_DIR", "./upload/");
require_once("db/database.php");
require_once("orm/Student.php");
require_once("repo/StudentRepository.php");
require_once("SessionManager.php");
require_once 'AuthenticationManager.php';


$dbh = new DatabaseHelper("localhost", "root", "", "unibook", 3306);

//Repository
$studentRepo = new StudentRepository($dbh);

//Session
$sessionManager = new SessionManager();

//Authentication
$authManager = new AuthenticationManager($studentRepo, $sessionManager);

?>