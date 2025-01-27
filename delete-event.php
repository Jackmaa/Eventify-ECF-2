<?php
// Start the session
session_start();

// Check if the user is logged in
if (! isset($_SESSION["userid"])) {
    // If not, redirect to the login page
    header("Location: index.php");
    exit();
}

// Get the event ID and redirect page from the query parameters
$id_event = $_GET['id'];

// Include the database handler class
include './dbh.class.php';

// Create a new database connection
$connection = new Dbh;
$bdd        = $connection->getConnection();

try {
    // Prepare the SQL query to delete the event
    $req = $bdd->prepare('DELETE FROM `events` WHERE `id_event` = :id_event');
    // Bind the event ID parameter to the query
    $req->bindParam(':id_event', $id_event, PDO::PARAM_INT);
    // Execute the query
    $req->execute();

    // Redirect to the specified page after deletion
    header("Location: index.php");
    exit();
} catch (Exception $e) {
    // If there is an error, return it as a JSON response
    echo json_encode(['error' => $e->getMessage()]);
}
?>