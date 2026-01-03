<?php
require_once 'bootstrap.php';

$idToDelete = $_SESSION['userid'];

// Review
// - Get reviews written by the student
$reviews = $reviewRepo->findByIdStudent($idToDelete);
// - Delete those reviews
foreach ($reviews as $review) {
    $reviewRepo->deleteReview($review->getIdReview());
}

// Student
// - Delete student
$studentRepo->delete($idToDelete);

header("Location: " . CONTROLLER_PATH . "logout.php");
