<!-- Purpose: Contains the modals for the events page-->


<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="eventModalLabel">Create an event</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="create-event.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingTitle" placeholder="addatitle" name="title" autocomplete="on" required>
                <label for="floatingTitle">Title</label>
            </div>
            <div class="mb-3">
              <?php while ($category = $req2->fetch(PDO::FETCH_ASSOC)) {?>
                <input
                type="radio"
                class="btn-check"
                name="category" id="<?php echo $category['name'] ?>"
                autocomplete="off"
                value="<?php echo $category['name'] ?>"
                required>
                <label class="btn btn-outline-primary" for="<?php echo $category['name'] ?>"><?php echo $category['name'] ?></label>

                <?php }?> <!-- Display all the categories in the database -->
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingLocation" placeholder="where" name="location" autocomplete="on" required>
                <label for="floatingLocation">Location</label>
            </div>
            <div class="form-floating mb-3">
                <textarea type="textarea" class="form-control" id="floatingDesc" placeholder="Describe your event" name="description" autocomplete="on" required></textarea>
                <label for="floatingDesc">Description</label>
            </div>
            <div class="mb-3 d-flex justify-content-evenly">
                <label for="date-start">When ?</label>
                <input type="date" id="date-start" name="date_start"/>
                <label for="hour-start">Start time</label>
                <input type="time" id="hour-start" name="hour_start" step="1800"/> <!-- 30 minutes step not very well supported ATM-->
            </div>
            <div class="mb-3 d-flex justify-content-evenly">
                <label for="date-end">To :</label>
                <input type="date" id="date-end" name="date_end"/>
                <label for="hour-end">End time</label>
                <input type="time" id="hour-end" name="hour_end" step="1800"/> <!-- 30 minutes step not very well supported ATM-->
            </div>
            <button type="submit" name="submit" class="btn btn-primary">EVENTIFY IT</button> <!-- Submit button for login form -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary justify-self-center" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
