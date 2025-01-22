<?php
session_start();
include './dbh.class.php';
$connection = new Dbh;
$bdd        = $connection->getConnection();

var_dump($_POST);
var_dump($_SESSION);

if (isset($_POST['submit'])) {
    $title       = $_POST['title'];
    $description = $_POST['description'];
    $date_start  = $_POST['date_start'];
    $date_end    = $_POST['date_end'];
    $hour_start  = $_POST['hour_start'];
    $hour_end    = $_POST['hour_end'];
    $id_user     = $_SESSION['userid'];

    $req = $bdd->prepare(
        'INSERT INTO `events`
        (`title`, `description`, `date_start`, `date_end`, `hour_start`, `hour_end`, `id_user`)
        VALUES
        (:title, :description, :date_start, :date_end, :hour_start, :hour_end, :id_user);'
    );
    $req->bindParam(':title', $title, PDO::PARAM_STR);
    $req->bindParam(':description', $description, PDO::PARAM_STR);
    $req->bindParam(':date_start', $date_start, PDO::PARAM_STR);
    $req->bindParam(':date_end', $date_end, PDO::PARAM_STR);
    $req->bindParam(':hour_start', $hour_start, PDO::PARAM_STR);
    $req->bindParam(':hour_end', $hour_end, PDO::PARAM_STR);
    $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $req->execute();
    header('Location: events.php');
}