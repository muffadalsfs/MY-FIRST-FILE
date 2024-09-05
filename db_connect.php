<?php
$servername = "localhost";
$db_username = "root"; // Changed to avoid conflict with form data
$db_password = "";
$dbname = "blog_db";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Username and password to insert (replace these with form data in practice)
$user_to_insert = "root"; // Replace with the actual username from form data
$plain_password = "yourpassword"; // Replace with the actual password from form data

// Check if username already exists
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $user_to_insert);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Error: Username already exists.";
} else {
    // If username does not exist, insert the new user
    $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $user_to_insert, $hashed_password);
    if ($stmt->execute()) {
        echo "User registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
