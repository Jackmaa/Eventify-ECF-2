<?php
    session_start();
    $title            = "Homepage";
    $meta_description = "Our interactive calendar makes it easy to view your events.";
    include './dbh.class.php'; // Include the database handler
    $bdd  = new Dbh();         // Create a new database handler
    $bdd  = $bdd->getConnection();
    $req2 = $bdd->prepare(
        'SELECT
      `name`
      FROM
      `category`;'); // Prepare the SQL statement to select all categories
    $req2->execute();    // Execute the SQL statement
?>
<?php include './header.php'; ?>

<section id="schedule">
    <div class="container">
        <div class="left d-flex justify-content-between">
            <div class="calendar">
              <div class="month d-flex justify-content-between">
                <span class="prev">&lt;</span>
                <div class="date"></div>
                <span class="next">&gt;</span>
              </div>

              <div class="weekdays">
                <div>SUN</div>
                <div>MON</div>
                <div>TUE</div>
                <div>WED</div>
                <div>THU</div>
                <div>FRI</div>
                <div>SAT</div>
              </div>
              <div class="days"></div>
            </div>
        </div>
        <div class="right">
            <div class="today-date">
              <div class="event-day">SUN</div>
              <div class="event-date">1 DECEMBER</div>
                <button type="button" class="btn btn-lg position-sticky z-3 top-0" data-bs-toggle="modal" data-bs-target="#eventModal" data-toggle="tooltip" data-placement="left" title="Add an Event!"> <!-- Button to open the modal to add a new event -->
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#3893c2" class="bi bi-plus-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>
                </button> <!-- Button to open the modal to add a new event -->
            </div>
            <div class="events"></div>
        </div>
    </div>
</section>
<script src="./assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php
    include './modals/login-modal.php';
    include './modals/signup-modal.php';
    include './modals/events-modal.php';
?>
</body>
</html>