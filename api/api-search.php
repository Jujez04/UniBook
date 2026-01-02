<?php
require_once __DIR__ . '/../controller/bootstrap.php';

header('Content-type: application/json');

$query = $_GET['q'] ?? '';

try {
    $books = $bookRepo->search($query);

    $results = [];
    foreach ($books as $book) {
        $results[] = [
            'id' => $book->getCodeBook(),
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'image' => $book->getImage()
        ];
    }
    echo json_encode($results);
} catch (Exception $e) {
    echo json_encode([]);
}
?>