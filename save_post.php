<?php
$conn = new mysqli('localhost', 'root', '', 'blog_db');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$title = $_POST['title'];
$content = $_POST['content'];

$sql = "INSERT INTO posts (title, content) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $title, $content);

if ($stmt->execute()) {
    header('Location: index.php');
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
