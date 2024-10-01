<?php
session_start();
require_once 'condb.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to prevent SQL injection
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Fetch user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists and verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Store user information in session
        $_SESSION['username'] = $username;
        header("Location: index.php"); // Redirect to the main page
        exit();
    } else {
        // Redirect back with an error message
        header("Location: login.php?error=" . urlencode("Invalid username or password"));
        exit();
    }
}
