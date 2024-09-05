<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Proceed with the rest of the code for editing or deleting the blog post



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

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$image = $_FILES['image']['name'];
$image_tmp = $_FILES['image']['tmp_name'];

if ($image) {
    move_uploaded_file($image_tmp, "image/$image");
    $sql = "UPDATE blogs SET title = ?, content = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $content, $image, $id);
} else {
    $sql = "UPDATE blogs SET title = ?, content = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $content, $id);
}

$stmt->execute();
$stmt->close();
$conn->close();

header("Location: blog.php");
?>
