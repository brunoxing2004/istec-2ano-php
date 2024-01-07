<?php
// action_register.php
require_once './database/connection.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username and password
    $submittedUsername = $_POST['username'];
    $submittedPassword = $_POST['password'];
    $submittedName = $_POST['name'];

    // Hash the password using BCRYPT
    $hashedPassword = password_hash($submittedPassword, PASSWORD_BCRYPT);

    // Insert the new user into the database
    $db = getDatabaseConnection(); // Use the function from connection.php
    $query = "INSERT INTO users (username, password, name) VALUES (:username, :password, :name)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $submittedUsername);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':name', $submittedName);

    if ($stmt->execute()) {
        // Registration successful
        echo 'User registered successfully';
        // You might want to redirect or display a success message
        sleep(2);
        header("Location: index.php");
    } else {
        // Registration failed
        echo 'Error registering user';
        // You might want to redirect or display an error message
    }
} else {
    // If the form was not submitted via POST, redirect to an error page or another appropriate location
    header('Location: error_page.php');
    exit;
}
?>
