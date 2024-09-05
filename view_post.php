<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post | My Blog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Post Details</h1>
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
            echo "<article>";
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
            if ($row['image']) {
                echo "<img src='image/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['title']) . "' />";
            }
            echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
            echo "</article>";
        } else {
            echo "<p>Post not found.</p>";
        }

        $conn->close();
        ?>
    </main>
</body>
</html>
