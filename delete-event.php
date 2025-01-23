<?php
include './dbh.class.php'; // Include the database connection class

$connection = new Dbh;                      // Create a new database connection instance
$bdd        = $connection->getConnection(); // Get the database connection

if (isset($_GET['id'])) { // Check if the event ID is provided in the URL
    $id = $_GET['id'];        // Get the event ID from the URL

    $req = $bdd->prepare(
        'DELETE FROM `events` WHERE `id_event` = :id;'
    ); // Prepare the SQL statement to delete the event

    $req->bindParam(':id', $id, PDO::PARAM_INT); // Bind the event ID parameter

    $req->execute(); // Execute the SQL statement

    header('Location: events.php'); // Redirect to the events page after deletion
    exit();                         // Ensure that the script stops executing after the redirect
}