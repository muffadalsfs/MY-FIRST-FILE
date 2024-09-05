<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Post | My Blog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Add New Post</h1>
        <nav>
            <a href="index.php">Home</a>
        </nav>
    </header>
    <main>
        <form action="add_post.php" method="post" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea>

            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image">

            <input type="submit" name="submit" value="Add Post">
            <a href="index.php" style="
    display: inline-block;
    background-color: #6c757d;
    color: #fff;
    border: 2px solid #6c757d;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease;
">Back</a>
        </form>
    </main>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'blog_db');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $image = '';

    if ($_FILES['image']['name']) {
        $image = basename($_FILES['image']['name']);
        $target = "image/" . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    $sql = "INSERT INTO post (title, content, image) VALUES ('$title', '$content', '$image')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
