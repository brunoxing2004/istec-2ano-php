<?php
// action_login.php
session_start(); // Start the session

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username and password
    $submittedUsername = $_POST['username'];
    $submittedPassword = $_POST['password'];

    // Validate the username and password (replace with your authentication logic)
    if ($submittedUsername === 'username' && $submittedPassword === 'password') {
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
    header('Location: error_page.php');
    exit;
}
?>
