<?php
// Start the session
session_start();

// Check if the user is logged in
if (! isset($_SESSION["userid"])) {
    // If not, redirect to the login page
    header("Location: index.php");
    exit();
}

// Get the user ID from the session
$id = $_SESSION['userid'];

// Include the database handler class
include './dbh.class.php';

// Create a new database connection
$connection = new Dbh;
$bdd        = $connection->getConnection();

try {
    // Prepare the SQL query to fetch events for the logged-in user
    $req = $bdd->prepare(
        'SELECT
          `id_event`,
          `title`,
          `location`,
          `description`,
          `date_start`,
          `date_end`,
          `hour_start`,
          `hour_end`,
          `category_name`,
          CONCAT(`date_start`, "T", `hour_start`) AS `start`
        FROM
            `events`
        WHERE
            `id_user` = :id
        ORDER BY
            `start` ASC;'
    );
    // Bind the user ID parameter to the query
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    // Execute the query
    $req->execute();

    // Fetch all the results as an associative array
    $events = $req->fetchAll(PDO::FETCH_ASSOC);
    // Return the results as a JSON response
    echo json_encode($events);
} catch (Exception $e) {
    // If there is an error, return it as a JSON response
    echo json_encode(['error' => $e->getMessage()]);
}
?>