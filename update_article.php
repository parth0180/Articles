<?php
include("db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the article
    $sql = "SELECT * FROM articles WHERE id=$id";
    $result = $conn->query($sql);
    $article = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $slug = $_POST['slug'];

    $sql = "UPDATE articles SET title='$title', description='$description', category='$category', slug='$slug', updated_at=NOW() WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Redirect to articles.php after updating
        header("Location: articles.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Article</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Update Article</h1>
        <form action="update_article.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo $article['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control" rows="10" required><?php echo $article['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" class="form-control" value="<?php echo $article['category']; ?>" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug:</label>
                <input type="text" id="slug" name="slug" class="form-control" value="<?php echo $article['slug']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Article</button>
            <a href="articles.php" class="btn btn-secondary">Close</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>