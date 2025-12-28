<?php
session_start();
define("UPLOAD_DIR", "./upload/");
require_once("db/database.php");
require_once("orm/Student.php");
require_once("repo/StudentRepository.php");
require_once("repo/BookingRepository.php");
require_once("repo/BookRepository.php");
require_once("repo/CatalogueRepository.php");
require_once("repo/LoanRepository.php");
require_once("repo/ReviewRepository.php");
require_once("SessionManager.php");
require_once 'AuthenticationManager.php';


$dbh = new DatabaseHelper("localhost", "root", "", "unibook", 3306);

//Repository
$studentRepo = new StudentRepository($dbh);
$bookingRepo = new BookingRepository($dbh);
$bookRepo = new BookRepository($dbh);
$catalogueRepo = new CatalogueRepository($dbh);
$loanRepo = new LoanRepository($dbh);
$reviewRepo = new ReviewRepository($dbh);

//Session
$sessionManager = new SessionManager();

//Authentication
$authManager = new AuthenticationManager($studentRepo, $sessionManager);

?>