<?php
include("db.php");
$search = '';
$orderBy = 'created_at';
$orderDir = 'DESC';

if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
}

if (isset($_GET['order_by'])) {
    $orderBy = $conn->real_escape_string($_GET['order_by']);
}

if (isset($_GET['order_dir'])) {
    $orderDir = $conn->real_escape_string($_GET['order_dir']);
    if (!in_array($orderDir, ['ASC', 'DESC'])) {
        $orderDir = 'DESC';
    }
}

$sql = "SELECT id, title, description, category, slug, created_at, updated_at FROM articles";
if (!empty($search)) {
    $sql .= " WHERE title LIKE '%$search%' OR description LIKE '%$search%' OR category LIKE '%$search%' OR slug LIKE '%$search%'";
}

$sql .= " ORDER BY $orderBy $orderDir";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Article Management</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Add Article</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="mb-4">Articles</h1>
        <form method="GET" action="articles.php" class="mb-4">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search articles..." value="<?php echo htmlspecialchars($search); ?>">
                <select name="order_by" class="form-control">
                    <option value="created_at" <?php echo $orderBy === 'created_at' ? 'selected' : ''; ?>>Created At</option>
                    <option value="updated_at" <?php echo $orderBy === 'updated_at' ? 'selected' : ''; ?>>Updated At</option>
                </select>
                <select name="order_dir" class="form-control">
                    <option value="DESC" <?php echo $orderDir === 'DESC' ? 'selected' : ''; ?>>Descending</option>
                    <option value="ASC" <?php echo $orderDir === 'ASC' ? 'selected' : ''; ?>>Ascending</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>

        <?php
        if ($result->num_rows > 0) {
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">ID</th>';
            echo '<th scope="col">Title</th>';
            echo '<th scope="col">Category</th>';
            echo '<th scope="col">Slug</th>';
            echo '<th scope="col">Description</th>';
            echo '<th scope="col">Created At</th>';
            echo '<th scope="col">Updated At</th>';
            echo '<th scope="col">Actions</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                $created_at = date("Y-m-d", strtotime($row["created_at"]));
                $updated_at = date("Y-m-d", strtotime($row["updated_at"]));
                echo '<tr>';
                echo '<th scope="row">' . $row["id"] . '</th>';
                echo '<td>' . $row["title"] . '</td>';
                echo '<td>' . $row["category"] . '</td>';
                echo '<td>' . $row["slug"] . '</td>';
                echo '<td>' . $row["description"] . '</td>';
                echo '<td>' . $created_at . '</td>';
                echo '<td>' . $updated_at . '</td>';
                echo '<td>';
                echo '<a href="update_article.php?id=' . $row["id"] . '" class="btn btn-primary btn-sm inline-block">Update</a> ';
                echo '<a href="delete_article.php?id=' . $row["id"] . '" class="btn btn-danger btn-sm inline-block" onclick="return confirm(\'Are you sure you want to delete this article?\')">Delete</a>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<div class="alert alert-warning" role="alert">No articles found.</div>';
        }
        $conn->close();
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>