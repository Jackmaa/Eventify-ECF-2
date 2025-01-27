<?php
session_start();                            // Start the session
include './dbh.class.php';                  // Include the database handler class
$connection = new Dbh;                      // Create a new instance of the database handler
$bdd        = $connection->getConnection(); // Get the database connection

if (isset($_POST['auto_delete'])) { // Check if the auto_delete POST variable is set
    $autoDelete = 1;                    // Set autoDelete to 1 if the checkbox is checked
} else {
    $autoDelete = 0; // Set autoDelete to 0 if the checkbox is not checked
}

$id_user = $_SESSION['userid']; // Get the user ID from the session

$stmt = $bdd->prepare('UPDATE `user` SET `auto_delete_past_events` = :auto_delete WHERE `id_user` = :id'); // Prepare the SQL statement
$stmt->bindParam(':auto_delete', $autoDelete, PDO::PARAM_INT);                                             // Bind the autoDelete variable to the SQL statement
$stmt->bindParam(':id', $id_user, PDO::PARAM_INT);                                                         // Bind the user ID to the SQL statement
$stmt->execute();                                                                                          // Execute the SQL statement

header('Location: user-profile.php?id=' . $id_user); // Redirect to the user profile page
exit();                                              // Exit the script
?>