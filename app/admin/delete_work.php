<?php
session_start();
include('config.php');

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

// Check if an ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL statement to delete the review
    $sql = "DELETE FROM trabajos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the admin panel with a success message
        header("Location: admin.php?message=Experience deleted successfully.");
        exit;
    } else {
        echo "Error deleting the experience: " . $stmt->error;
    }
} else {
    echo "No experience ID provided.";
}
?>
