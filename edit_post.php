<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post | My Blog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Edit Post</h1>
        <nav>
            <a href="index.php">Home</a>
            
        </nav>
    </header>
    <main>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'blog_db');

        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        $id = intval($_GET['id']);
        $sql = "SELECT * FROM post WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
        } else {
            echo "<p>Post not found.</p>";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $conn->real_escape_string($_POST['title']);
            $content = $conn->real_escape_string($_POST['content']);
            $image = $row['image'];

            if ($_FILES['image']['name']) {
                $image = basename($_FILES['image']['name']);
                $target = "image/" . $image;
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
            }

            $sql = "UPDATE post SET title='$title', content='$content', image='$image' WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                header("Location: view_post.php?id=" . $id);
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
        ?>
        <form action="edit_post.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($row['title']) ?>" required>

            <label for="content">Content:</label>
            <textarea id="content" name="content" required><?= htmlspecialchars($row['content']) ?></textarea>

            <label for="image">Change Image:</label>
            <input type="file" id="image" name="image">
            <?php if ($row['image']) : ?>
                <p>Current Image: <img src="image/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" width="150"></p>
            <?php endif; ?>

            <input type="submit" value="Update Post">
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
