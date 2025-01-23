<?php
    session_start();
    include './dbh.class.php';
    $connection = new Dbh;
    $bdd        = $connection->getConnection();

    $id  = $_GET['id'];
    $req = $bdd->prepare(
        'SELECT
    `id_event`,`title`,`location`,`description`,`date_start`,`date_end`,`hour_start`,`hour_end`
    FROM
    `events`
    WHERE `id_event` = :id;');
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
?>
<?php
    include './header.php';
?>
<div class="container">
    <div class="card text-center m-3 p-3" max-width="25rem">
        <form action="create-event.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingTitle" placeholder="addatitle" name="title" autocomplete="on" required>
                <label for="floatingTitle">Title</label>
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
            <button type="submit" name="submit" class="btn btn-primary mt-5">EVENTIFY IT</button> <!-- Submit button for login form -->
        </form>
    </div>
</div>