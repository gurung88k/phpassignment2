<?php
include('shared/auth.php');

// Read the showId from the URL parameter using $_GET   
$showId = $_GET['showId'];

if (is_numeric($showId)) {
    try {
        // Connect to the database
        include('shared/db.php');

        // Prepare SQL DELETE
        $sql = "DELETE FROM shows WHERE showId = :showId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':showId', $showId, PDO::PARAM_INT);

        // Execute the delete
        $cmd->execute();

        // Disconnect from the database
        $db = null;

        // Show a message (temporarily)
        echo 'Show Deleted';

        // Redirect back to updated shows.php (eventually)
        header('location:shows.php');
        exit();
    } catch (Exception $err) {
        // Redirect to error page if there's an error
        header('location:error.php');
        exit();
    }
} else {
    // Redirect if showId is not provided or invalid
    header('location:error.php');
    exit();
}
?>
