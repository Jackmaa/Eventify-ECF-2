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
<?php
    include './header.php';
    include './modals/events-modal.php';
?>
<div class="container col-lg-3 d-flex justify-content-center">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">
        Add an Event
  </button>
</div>
<?php
    while ($product = $req->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <div class="card text-center m-3" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title"><?php echo $product['title'] ?></h5>
            <p class="card-text"><?php echo $product['description'] ?></p>
            <p class="card-text"><?php echo $product['location'] ?></p>
            <p class="card-text"><?php echo $product['date_start'] . ' ' . substr($product['hour_start'], 0, -3) ?></p> <!-- Remove the seconds from the time -->
            <p class="card-text"><?php echo $product['date_end'] . ' ' . substr($product['hour_end'], 0, -3) ?></p><!-- Remove the seconds from the time -->
            <a href="edit-event.php?id=<?php echo $product['id_event'] ?>" class="btn btn-primary">Edit</a>
            <a href="delete-event.php?id=<?php echo $product['id_event'] ?>" class="btn btn-danger">Delete</a>
          </div>
        </div>

<?php
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="./assets/js/date-input.js"></script>
</body>
</html>