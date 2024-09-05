<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch blog posts
$sql = "SELECT * FROM post";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
        <a href="add_blog.php">Add New Blog</a>
    <?php endif; ?>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="blog-post">
            <h2><?php echo htmlspecialchars($row['title']); ?></h2>
            <p><?php echo htmlspecialchars($row['content']); ?></p>
            <?php if ($row['image']): ?>
                <img src="image/<?php echo htmlspecialchars($row['image']); ?>" alt="Blog Image">
            <?php endif; ?>

            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                <a href="edit_blog.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete_blog.php?id=<?php echo $row['id']; ?>">Delete</a>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>

    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
        <a href="logout.php">Logout</a>
    <?php endif; ?>
</body>
</html>

<?php
$conn->close();
?>
<?php
session_start();
session_unset();
session_destroy();
header("Location: blog.php");  // Redirect to the blog page after logging out
?>

