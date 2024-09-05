<?php
$conn = new mysqli('localhost', 'root', '', 'blog_db');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$id = intval($_GET['id']);
$sql = "DELETE FROM post WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error deleting post: " . $conn->error;
}

$conn->close();
?>
