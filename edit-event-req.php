<?php
include './dbh.class.php';                  // Include the database connection class
$connection = new Dbh;                      // Create a new database connection instance
$bdd        = $connection->getConnection(); // Get the database connection

if (isset($_POST['submit'])) {        // Check if the form is submitted
    $title       = $_POST['title'];       // Get the title from the form
    $location    = $_POST['location'];    // Get the location from the form
    $description = $_POST['description']; // Get the description from the form
    $date_start  = $_POST['date_start'];  // Get the start date from the form
    $date_end    = $_POST['date_end'];    // Get the end date from the form
    $hour_start  = $_POST['hour_start'];  // Get the start time from the form
    $hour_end    = $_POST['hour_end'];    // Get the end time from the form
    $id_event    = $_POST['id'];          // Get the event ID from the form
    $category    = $_POST['category'];    // Get the category from the form

    $req = $bdd->prepare(
        'UPDATE
            `events`
        SET
            `title` = :title,
            `location` = :location,
            `description` = :description,
            `date_start` = :date_start,
            `date_end` = :date_end,
            `hour_start` = :hour_start,
            `hour_end` = :hour_end,
            `category_name` = :category
        WHERE
            `events`.`id_event` = :id_event;'
    );                                                             // Prepare the SQL statement to update the event details
    $req->bindParam(':title', $title, PDO::PARAM_STR);             // Bind the title parameter
    $req->bindParam(':location', $location, PDO::PARAM_STR);       // Bind the location parameter
    $req->bindParam(':description', $description, PDO::PARAM_STR); // Bind the description parameter
    $req->bindParam(':date_start', $date_start, PDO::PARAM_STR);   // Bind the start date parameter
    $req->bindParam(':date_end', $date_end, PDO::PARAM_STR);       // Bind the end date parameter
    $req->bindParam(':hour_start', $hour_start, PDO::PARAM_STR);   // Bind the start time parameter
    $req->bindParam(':hour_end', $hour_end, PDO::PARAM_STR);       // Bind the end time parameter
    $req->bindParam(':category', $category, PDO::PARAM_STR);       // Bind the category parameter
    $req->bindParam(':id_event', $id_event, PDO::PARAM_INT);       // Bind the event ID parameter
    $req->execute();                                               // Execute the SQL statement
    header('Location: events.php');                                // Redirect to the events page
}