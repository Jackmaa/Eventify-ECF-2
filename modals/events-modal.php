<!-- Purpose: Contains the modals for the events page-->


<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="eventModalLabel">Create an event</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="create-event.php<?php echo $redirect ?>" method="post">
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
                <input
                type="text"
                class="form-control"
                id="floatingLocation"
                placeholder="where"
                name="location"
                autocomplete="on"
                required>
                <label for="floatingLocation">Location</label>
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
                style="height: 150px;"></textarea>
                <label for="floatingDesc">Description</label>
            </div>
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
            <button type="submit" name="submit" class="btn btn-primary">EVENTIFY IT</button> <!-- Submit button for login form -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary justify-self-center" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
