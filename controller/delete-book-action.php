<?php
require_once 'bootstrap.php';

$idToDelete = $_POST['idbook'];
$redirectUrl = $_POST['redirect_url'];

// Review
// - Get reviews written for that book
$reviews = $reviewRepo->getReviewsByBook($idToDelete);
// - Delete those reviews
foreach ($reviews as $review) {
    $reviewRepo->deleteReview($review->getIdReview());
}

// Book
// - Delete book
$bookRepo->deleteBook($idToDelete);

header("Location: " . BASE_URL . $redirectUrl);
?>
