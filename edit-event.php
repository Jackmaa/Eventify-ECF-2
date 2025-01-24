<?php
    session_start();                   // Start the session
    if (! isset($_SESSION["userid"])) { // Check if the user is not logged in
        header("Location: index.php");     // Redirect to the index page
        exit();                            // Exit the script
    }
    $title = "Edit Event";  // Set the page title
    include './header.php'; // Include the header file
    $id  = $_GET['id'];     // Get the event ID from the URL
    $req = $bdd->prepare(
        'SELECT
            `id_event`,
            `title`,
            `location`,
            `description`,
            `date_start`,
            `date_end`,
            `hour_start`,
            `hour_end`
        FROM
            `events`
        WHERE
            `id_event` = :id;'
    );                                           // Prepare the SQL statement to select the event details
    $req->bindParam(':id', $id, PDO::PARAM_INT); // Bind the event ID parameter
    $req->execute();                             // Execute the SQL statement

    $req2 = $bdd->prepare(
        'SELECT
        `name`
        FROM
        `category`;'); // Prepare the SQL statement to select all categories
    $req2->execute();      // Execute the SQL statement
?>
<div class="container col-lg-5 d-flex justify-content-center">
    <div class="card text-center m-3 p-3">
        <form action="edit-event-req.php" method="post"> <!-- Form to edit the event -->
        <?php
            while ($event = $req->fetch(PDO::FETCH_ASSOC)) { // Fetch and display the event details
            ?>
        <div class="form-floating mb-3">
            <input
                type="text"
                class="form-control"
                id="floatingTitle"
                placeholder="addatitle"
                name="title"
                autocomplete="on"
                required
                value="<?php echo $event['title']; ?>"><!-- Display the title of the event -->
            <label for="floatingTitle">Title</label>
            </div>

            <div class="form-floating mb-3">
                <input
                type="text"
                class="form-control"
                id="floatingLocation"
                placeholder="where"
                name="location"
                autocomplete="on"
                required
                value="<?php echo $event['location']; ?>"> <!-- Display the location of the event -->
                <label for="floatingLocation">Location</label>
            </div>
            <div class="mb-3">
            <?php while ($category = $req2->fetch(PDO::FETCH_ASSOC)) {?> <!-- Fetch and display all categories -->
                <input
                type="radio"
                class="btn-check"
                name="category" id="<?php echo $category['name'] ?>"
                autocomplete="off"
                value="<?php echo $category['name'] ?>"
                required>
                <label
                    class="btn btn-outline-primary"
                    for="<?php echo $category['name'] ?>">
                        <?php echo $category['name'] ?>
                </label>

            <?php }?>
            </div>
            <div class="form-floating mb-3">
                <textarea
                    type="textarea"
                    class="form-control"
                    id="floatingDesc"
                    placeholder="Describe your event"
                    name="description"
                    autocomplete="on"
                    required
                    style="height: 150px;"><?php echo $event['description']; ?></textarea> <!-- Display the description of the event -->
                <label for="floatingDesc">Description</label>
            </div>
            <?php
            }?>
            <div class="mb-3">
                <div class="row">
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                        <label for="date-start">When?</label>
                        <input type="date" id="date-start" name="date_start" class="form-control"/>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="hour-start">Start time</label>
                        <input type="time" id="hour-start" name="hour_start" class="form-control" step="1800"/>
                        <small class="form-text text-muted">Please select the start time (in 30 mins intervals).</small>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                        <label for="date-end">To:</label>
                        <input type="date" id="date-end" name="date_end" class="form-control"/>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="hour-end">End time</label>
                        <input type="time" id="hour-end" name="hour_end" class="form-control" step="1800"/>
                        <small class="form-text text-muted">Please select the end time (in 30 mins intervals).</small>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">  <!-- Hidden input to pass the event ID -->
            <button type="submit" name="submit" class="btn btn-primary mt-5">EVENTIFY IT</button> <!-- Submit button -->
            <a href="events.php" class="btn btn-danger mt-5"> CANCEL</a> <!-- Cancel button -->
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> <!-- Include Bootstrap JS -->
<script src="./assets/js/date-input.js"></script> <!-- Include the date-input.js script -->
</body>