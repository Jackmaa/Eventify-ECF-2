<?php
    session_start();                   // Start the session
    if (! isset($_SESSION["userid"])) { // Check if the user is not logged in
        header("Location: index.php");     // Redirect to the index page
        exit();                            // Exit the script
    }
    $title = "My Events";       // Set the page title
    include './header.php';     // Include the header file
    $id  = $_SESSION['userid']; // Get the user ID from the session
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
            `start` ASC;');                  // Prepare the SQL statement to select the user's events
    $req->bindParam(':id', $id, PDO::PARAM_INT); // Bind the user ID parameter
    $req->execute();                             // Execute the SQL statement

    $req2 = $bdd->prepare(
        'SELECT
        `name`
        FROM
        `category`;'); // Prepare the SQL statement to select all categories
    $req2->execute();      // Execute the SQL statement
?>
<?php

?>
<div class="bg-transparent d-flex justify-content-end position-sticky z-3 top-0"> <!-- Sticky container for the add event button -->
  <button type="button" class="btn btn-lg position-sticky z-3 top-0" data-bs-toggle="modal" data-bs-target="#eventModal" data-toggle="tooltip" data-placement="left" title="Add an Event!"> <!-- Button to open the modal to add a new event -->
  <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#3893c2" class="bi bi-plus-circle" viewBox="0 0 16 16">
    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
  </svg>
  </button> <!-- Button to open the modal to add a new event -->
</div>
<h1 class="text-center">My Events</h1> <!-- Heading for the events section -->
  <div class="container flex-wrap d-flex flex-row justify-content-center">
    <?php
        while ($product = $req->fetch(PDO::FETCH_ASSOC)) { // Fetch and display each event
        ?>
        <div class="card bg-dark text-center m-3 p-3" style="width: 18rem;">
          <img class="card-image" src="./assets/img/<?php echo $product['category_name'] ?>" alt="<?php echo $product['category_name'] ?> Icon"> <!-- Display the category image -->
          <div class="card-img-overlay d-flex flex-column align-items-center justify-content-center">
            <h5 class="card-title"><?php echo $product['title'] ?></h5> <!-- Display the event title -->
            <p class="card-text"><?php echo $product['description'] ?></p> <!-- Display the event description -->
            <p class="card-text"><?php echo $product['location'] ?></p> <!-- Display the event location -->
            <p class="card-text"><?php echo $product['date_start'] . ' ' . substr($product['hour_start'], 0, -3) ?></p> <!-- Display the start date and time without seconds -->
            <p class="card-text"><?php echo $product['date_end'] . ' ' . substr($product['hour_end'], 0, -3) ?></p> <!-- Display the end date and time without seconds -->
            <div class="d-flex justify-content-evenly w-100">
              <a href="edit-event.php?id=<?php echo $product['id_event'] ?>" class="btn btn-primary">Edit</a> <!-- Link to edit the event -->
              <a href="delete-event.php?id=<?php echo $product['id_event'] ?>" class="btn btn-danger">Delete</a> <!-- Link to delete the event -->
            </div>
          </div>
        </div>

<?php
    }
    include './modals/events-modal.php'; // Include the modal for adding events
?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> <!-- Include Bootstrap JS -->
<script src="./assets/js/date-input.js"></script> <!-- Include the date-input.js script -->
</body>
</html>