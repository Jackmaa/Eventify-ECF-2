<?php
    session_start();
    include './dbh.class.php';

    $connection = new Dbh;
    $bdd        = $connection->getConnection();
    $id         = $_SESSION['userid'];
    $req        = $bdd->prepare(
        'SELECT
        `id_event`,`title`,`location`,`description`,`date_start`,`date_end`,`hour_start`,`hour_end`
        FROM
        `events`
        WHERE `id_user` = :id;');
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/styles/styles.css">
    <title>Document</title>
</head>
<?php include './header.php'?>
<?php
    while ($product = $req->fetch(PDO::FETCH_ASSOC)) {
        echo '
        <div class="card text-center m-3" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title">' . $product['title'] . '</h5>
            <p class="card-text">' . $product['description'] . '</p>
            <p class="card-text">' . $product['location'] . '</p>
            <p class="card-text">' . $product['date_start'] . ' ' . $product['hour_start'] . '</p>
            <p class="card-text">' . $product['date_end'] . ' ' . $product['hour_end'] . '</p>
            <a href="edit-event.php?id=' . $product['id_event'] . '" class="btn btn-primary">Edit</a>
            <a href="delete-event.php?id=' . $product['id_event'] . '" class="btn btn-danger">Delete</a>
          </div>
          </div>';
    }
?>

<div class="container col-lg-3">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">
        Add an Event
  </button>
</div>
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="eventModalLabel">Connectez vous</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="create-event.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingUser" placeholder="addatitle" name="title" autocomplete="on" required>
                <label for="floatingUser">Add a title</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingPass" placeholder="where" name="location" autocomplete="on" required>
                <label for="floatingPass">Where ?</label>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="./assets/js/date-input.js"></script>
</body>
</html>