<?php
session_start();

// Assuming successful authentication
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Load user credentials from the users.txt file
    $usersFile = "users.txt";
    $usersData = file($usersFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Check if the file exists and is readable
    if ($usersData !== false) {
        foreach ($usersData as $userData) {
            list($fileUsername, $hashedPassword) = explode(":", $userData);
            if ($username === $fileUsername && password_verify($password, $hashedPassword)) {
                // Authentication successful
                $_SESSION['username'] = $username; // Store user data in session

                // Redirect to dashboard.html after successful login
                header("Location: dashboard.html");
                exit();
            }
        }
    }

    // Invalid credentials, redirect back to login page
    header("Location: index.html"); // Change this to your login page
    exit();
} else {
    // Redirect to login page if accessed directly without form submission
    header("Location: index.html"); // Change this to your login page
    exit();
}
?>
