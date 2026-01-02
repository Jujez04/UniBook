<?php
require_once __DIR__ . '/../controller/bootstrap.php';

header('Content-type: application/json');

$bookID = $_GET['id'] ?? '';

$reviews = $reviewRepo->getReviewsByBook($bookID);
$results = [];
foreach ($reviews as $review) {
    $student = $studentRepo->findByEmail($review['email']);
    $results[] = [
        'student_name' => $student->getName(),
        'student_surname' => $student->getSurname(),
        'student_profile_image' => UPLOAD_DIR . 'students/' . $student->getProfileImage(),
        'rating' => $review['rating'],
        'description' => $review['description']
    ];
}

echo json_encode($results);
?>