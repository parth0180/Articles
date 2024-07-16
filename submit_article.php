<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $slug = $_POST['slug'];

    $sql = "INSERT INTO articles (title, description, category, slug) VALUES ('$title', '$description', '$category', '$slug')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to articles.php after successful insertion
        header('Location: articles.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
