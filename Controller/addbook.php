<?php
session_start();

if (!isset($_SESSION['library'])) {
    $_SESSION['library'] = [];
}

$errors = [];

$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$author = isset($_POST['author']) ? trim($_POST['author']) : '';
$year = isset($_POST['year']) ? trim($_POST['year']) : '';
$genre = isset($_POST['genre']) ? trim($_POST['genre']) : '';

if (empty($title)) {
    $errors[] = "Title is required.";
}

if (empty($author)) {
    $errors[] = "Author is required.";
}

if (empty($year)) {
    $errors[] = "Year is required.";
} elseif (!is_numeric($year)) {
    $errors[] = "Year must be a numeric value.";
}

if (!empty($errors)) {
    echo json_encode(["errors" => $errors]);
} else {
    $book = [
        'title' => $title,
        'author' => $author,
        'year' => $year,
        'genre' => $genre,
        'index' => $_SESSION['ind'],
    ];

    $_SESSION['ind']++;

    array_push($_SESSION['library'], $book);

    echo json_encode(["message" => "Book added successfully"]);
}
?>