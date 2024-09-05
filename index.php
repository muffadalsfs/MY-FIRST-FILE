<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>








<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    
</body>
</html>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | My Blog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>My Blog</h1>

        
        <nav>
            <a href="add_post.php">Add New Post</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'blog_db');

        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        $sql = "SELECT * FROM post ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<article>";
                echo "<h2><a href='view_post.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['title']) . "</a></h2>";
                if ($row['image']) {
                    echo "<img src='image/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['title']) . "' />";
                }
                echo "<p><a href='edit_post.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete_post.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\");'>Delete</a></p>";
                echo "</article>";
            }
        } else {
            echo "<p>No posts available.</p>";
        }

        $conn->close();
        ?>
    </main>
</body>
</html>

