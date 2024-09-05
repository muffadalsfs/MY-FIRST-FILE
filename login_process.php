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

$user = $_POST['username'];
$pass = $_POST['password'];

// Prepare and execute the query
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

// Check if a user is found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verify password
    if (password_verify($pass, $row['password'])) {
        // Store user data in session
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user;

        // Redirect to home page
        header("Location: index.php");
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found.";
}

$stmt->close();
$conn->close();
?>
