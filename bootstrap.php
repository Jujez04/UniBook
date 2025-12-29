<?php
session_start();
define("UPLOAD_DIR", "./upload/");

//Credenziali admin
define("ADMIN_EMAIL", "admin@unibook.com");
define("ADMIN_PASSWORD", "admin");

require_once("db/database.php");
require_once("orm/Student.php");
require_once("repo/StudentRepository.php");
require_once("repo/BookingRepository.php");
require_once("repo/BookRepository.php");
require_once("repo/CatalogueRepository.php");
require_once("repo/LoanRepository.php");
require_once("repo/ReviewRepository.php");
require_once("repo/TagInBookRepository.php");
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
$tagInBookRepo = new TagInBookRepository($dbh);

if ($studentRepo->findByEmail(ADMIN_EMAIL) === null) {
    $studentRepo->create(
        "Admin",
        "System",
        ADMIN_EMAIL,
        password_hash(ADMIN_PASSWORD, PASSWORD_DEFAULT),
        "0000000000"
    );
}

//Session
$sessionManager = new SessionManager();

//Authentication
$authManager = new AuthenticationManager($studentRepo, $sessionManager);

?>