<?php
session_start();
define("ROOT_URL", __DIR__ . "/../");
define("UPLOAD_DIR", ROOT_URL . "upload/");
define("CONTROLLER_DIR", ROOT_URL . "controller/");
//Credenziali admin
define("ADMIN_EMAIL", "admin@unibook.com");
define("ADMIN_PASSWORD", "admin");

require_once(ROOT_URL . "db/database.php");
require_once(ROOT_URL . "orm/Student.php");
require_once(ROOT_URL . "repo/StudentRepository.php");
require_once(ROOT_URL . "repo/BookingRepository.php");
require_once(ROOT_URL . "repo/BookRepository.php");
require_once(ROOT_URL . "repo/CatalogueRepository.php");
require_once(ROOT_URL . "repo/LoanRepository.php");
require_once(ROOT_URL . "repo/ReviewRepository.php");
require_once(ROOT_URL . "repo/TagInBookRepository.php");
require_once( "SessionManager.php");
require_once( "AuthenticationManager.php");


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