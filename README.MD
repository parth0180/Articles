
# Blog Application

This is a simple blog application built using HTML, CSS, PHP, and MySQL. It allows users to manage articles with basic CRUD operations.

### Features

- **Create Articles:** Add new articles with a title, description, category, and slug.
- **Read Articles:** View all articles with options to search and sort.
- **Update Articles:** Edit existing articles.
- **Delete Articles:** Remove articles from the database.

### Technologies Used

- **Frontend:** HTML, CSS (Bootstrap 4.5.2)
- **Backend:** PHP (7.4.x)
- **Database:** MySQL (8.0.x)

### Functionality Overview

#### Articles Page

The main functionality of the blog application is accessible through `articles.php`, where users can:

- **View Articles:** Displays a table listing all articles with details such as title, category, slug, description, creation date, and last update date.
- **Search Articles:** Use the search box to filter articles by title, category, slug, or description.
- **Sort Articles:** Click on column headers (`Created At` or `Updated At`) to sort articles in ascending or descending order.
- **Manage Articles:** Each article row includes `Update` and `Delete` buttons for editing and removing articles.

#### Update Article

- Clicking on the `Update` button redirects the user to `update_article.php`, where they can modify the content of an existing article.

#### Delete Article

- Clicking on the `Delete` button triggers the deletion of the article. A confirmation dialog ensures that the user intends to delete the article.

### Usage

1. **Clone the Repository:**

   Clone the repository to your local machine.

   ```bash
   git clone <repository-url>
   cd blog-application
   ```

2. **Database Configuration:**

   Update `db.php` with your MySQL database credentials.

   ```php
   <?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "blog_db";

   $conn = new mysqli($servername, $username, $password, $dbname);

   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   ?>
   ```

3. **Run the Application:**

   - Start your local web server (e.g., Apache).
   - Open `articles.php` in your web browser to manage articles.

     Example URL: `http://localhost/blog-application/articles.php`

### Notes

- This application uses Bootstrap 4.5.2 for styling and layout.
- Ensure to handle security considerations (e.g., input validation, SQL injection prevention) when deploying in production environments.

---

This README provides a clear overview of the blog application's features, how to use it, and important considerations. Adjust the paths, configurations, and additional details based on your specific setup and requirements.

<br>

# [Demo Link](https://photos.app.goo.gl/9y3R1vYqTwcxzM3u5)

<hr/>