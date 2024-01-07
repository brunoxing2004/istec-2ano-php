<?php
    // action_logout.php
    session_start(); // Start the session

    // Unset all session variables
    $_SESSION = [];

    // Destroy the session
    session_destroy();

    // Redirect back to the previous page or any other page
    $previousPage = $_SERVER['HTTP_REFERER'];
    header("Location: index.php"); // $previousPage
    exit;
?>
