<?php
include("db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM articles WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: articles.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
