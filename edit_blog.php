<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM post WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$blog = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Blog</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="edit_blog_process.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $blog['id']; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required><?php echo htmlspecialchars($blog['content']); ?></textarea>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image">
        <button type="submit">Update Blog</button>
    </form>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
