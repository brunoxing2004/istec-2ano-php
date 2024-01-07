<?php
// action_login.php
require_once './database/connection.php';
session_start(); // Start the session

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username and password
    $submittedUsername = $_POST['username'];
    $submittedPassword = $_POST['password'];

    // Validate the username and password using the database connection
    $db = getDatabaseConnection(); // Use the function from connection.php
    $query = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $submittedUsername);
    $stmt->bindParam(':password', $submittedPassword);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Authentication successful
        $_SESSION['username'] = $submittedUsername; // Store the username in the session

        // Redirect back to the previous page
        $previousPage = $_SERVER['HTTP_REFERER'];
        header("Location: index.php");
        exit;
    } else {
        // Authentication failed
        echo 'Invalid username or password';
        // You might want to redirect or display an error message
    }
} else {
    // If the form was not submitted via POST, redirect to an error page or another appropriate location
    header('Location: index.php');
    exit;
}
?>

