<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* style.css */
body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(to right, #00c6ff, #0072ff);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

form {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    color: #333;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #555;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
}

input:focus {
    border-color: #0072ff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 114, 255, 0.3);
}

button {
    width: 100%;
    padding: 10px;
    background-color: #0072ff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #005bb5;
}

button:focus {
    outline: none;
}

        </style>
</head>
<body>
    <form action="login_process.php" method="post">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
