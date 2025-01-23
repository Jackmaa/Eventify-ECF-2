<?php
    session_start();        // Start the session
    include './header.php'; // Include the header file
    $id  = $_GET['id'];     // Get the event ID from the URL
    $req = $bdd->prepare(
        'SELECT
    `id_event`,`title`,`location`,`description`,`date_start`,`date_end`,`hour_start`,`hour_end`
    FROM
    `events`
    WHERE `id_event` = :id;');               // Prepare the SQL statement to select the event details
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
            <div class="mb-3 d-flex justify-content-evenly align-items-center">
                <label
                    for="date-start">When ?
                </label>
                <input
                    type="date"
                    id="date-start"
                    name="date_start"/> <!-- Input for the start date -->
                <label for="hour-start">Start time</label>
                <input
                    type="time"
                    id="hour-start"
                    name="hour_start"
                    step="1800"/> <!-- Input for the start time with 30 minutes step -->
            </div>
            <div class="mb-3 d-flex justify-content-evenly align-items-center">
                <label for="date-end">To :</label>  <!-- Label for the end date input -->
                <input type="date" id="date-end" name="date_end"/>  <!-- Input for the end date -->
                <label for="hour-end">End time</label>  <!-- Label for the end time input -->
                <input type="time" id="hour-end" name="hour_end" step="1800"/> <!-- Input for the end time with 30 minutes step -->
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">  <!-- Hidden input to pass the event ID -->
            <button type="submit" name="submit" class="btn btn-primary mt-5">EVENTIFY IT</button> <!-- Submit button -->
            <a href="events.php" class="btn btn-danger mt-5"> CANCEL</a> <!-- Cancel button -->
        </form>
    </div>
</div>
<script src="./assets/js/date-input.js"></script> <!-- Include the date-input.js script -->
</body>