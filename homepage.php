<?php
    session_start();
    include './dbh.class.php';

    $connection = new Dbh;
    $bdd        = $connection->getConnection();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/styles/styles.css">
    <title>Eventify || Everyday is a task</title>
</head>
<?php include './header.php'?>
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
            </div>
            <div class="events"></div>
        </div>
    </div>
</section>
<script src="./assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>