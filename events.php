<?php
    session_start();
    include './header.php';
    $id  = $_SESSION['userid'];
    $req = $bdd->prepare(
        'SELECT
        `id_event`,`title`,`location`,`description`,`date_start`,`date_end`,`hour_start`,`hour_end`,`category_name`
        FROM
        `events`
        WHERE `id_user` = :id
        ORDER BY `date_start` ASC;');
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();

    $req2 = $bdd->prepare(
        'SELECT
        `name`
        FROM
        `category`;');
    $req2->execute();
?>
<?php

?>
<div class="container col-lg-3 d-flex justify-content-center">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">
        Add an Event
  </button>
</div>
<?php
    while ($product = $req->fetch(PDO::FETCH_ASSOC)) {
    ?>
      <div class="d-flex justify-content-center">
        <div class="card bg-dark text-center m-3 p-3" style="width: 18rem;">
          <img class="card-image" src="./assets/img/<?php echo $product['category_name'] ?>" alt="<?php echo $product['category_name'] ?> Icon">
          <div class="card-img-overlay d-flex flex-column align-items-center justify-content-center">
            <h5 class="card-title"><?php echo $product['title'] ?></h5>
            <p class="card-text"><?php echo $product['description'] ?></p>
            <p class="card-text"><?php echo $product['location'] ?></p>
            <p class="card-text"><?php echo $product['date_start'] . ' ' . substr($product['hour_start'], 0, -3) ?></p> <!-- Remove the seconds from the time -->
            <p class="card-text"><?php echo $product['date_end'] . ' ' . substr($product['hour_end'], 0, -3) ?></p><!-- Remove the seconds from the time -->
            <div>
              <a href="edit-event.php?id=<?php echo $product['id_event'] ?>" class="btn btn-primary">Edit</a>
              <a href="delete-event.php?id=<?php echo $product['id_event'] ?>" class="btn btn-danger">Delete</a>
            </div>
          </div>
        </div>
      </div>
<?php
    }
    include './modals/events-modal.php';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="./assets/js/date-input.js"></script>
</body>
</html>