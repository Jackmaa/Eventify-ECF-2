<?php
include './dbh.class.php';
$connection = new Dbh;
$bdd        = $connection->getConnection();
if (isset($_POST['submit'])) {
    $title       = $_POST['title'];
    $location    = $_POST['location'];
    $description = $_POST['description'];
    $date_start  = $_POST['date_start'];
    $date_end    = $_POST['date_end'];
    $hour_start  = $_POST['hour_start'];
    $hour_end    = $_POST['hour_end'];
    $id_event    = $_POST['id'];
    $category    = $_POST['category'];

    $req = $bdd->prepare(
        'UPDATE
        `events`
        SET
        `title` = :title,
        `location` = :location,
        `description` = :description,
        `date_start` = :date_start,
        `date_end` = :date_end,
        `hour_start` = :hour_start,
        `hour_end` = :hour_end,
        `category_name` = :category
        WHERE
        `events`.`id_event` = :id_event;'
    );
    $req->bindParam(':title', $title, PDO::PARAM_STR);
    $req->bindParam(':location', $location, PDO::PARAM_STR);
    $req->bindParam(':description', $description, PDO::PARAM_STR);
    $req->bindParam(':date_start', $date_start, PDO::PARAM_STR);
    $req->bindParam(':date_end', $date_end, PDO::PARAM_STR);
    $req->bindParam(':hour_start', $hour_start, PDO::PARAM_STR);
    $req->bindParam(':hour_end', $hour_end, PDO::PARAM_STR);
    $req->bindParam(':category', $category, PDO::PARAM_STR);
    $req->bindParam(':id_event', $id_event, PDO::PARAM_INT);
    $req->execute();
    header('Location: events.php');
}